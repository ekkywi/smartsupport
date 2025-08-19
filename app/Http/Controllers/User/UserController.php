<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Position;
use App\Models\Section;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['position', 'section', 'role'])->latest()->get();
        return view('contents.data-pengguna', compact('users'));
    }

    public function create()
    {
        $positions = Position::with('users')->get();
        $sections = Section::with('users')->get();
        $roles = Role::with('users')->get();
        return view('forms.tambah-pengguna', compact('positions', 'sections', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'section_id' => 'nullable|uuid|exists:sections,id',
                'position_id' => 'nullable|uuid|exists:positions,id',
                'role_id' => 'nullable|uuid|exists:roles,id',
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
                'username.unique' => 'Username sudah terdaftar, gunakan username lain.',
                'section_id.exists' => 'Bagian yang dipilih tidak valid.',
                'position_id.exists' => 'Jabatan yang dipilih tidak valid.',
                'role_id.exists' => 'Hak akses yang dipilih tidak valid.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password.min' => 'Password harus terdiri dari minimal 8 karakter.'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'section_id' => $request->section_id,
            'position_id' => $request->position_id,
            'role_id' => $request->role_id,
            'password' => $request->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::with(['position', 'section', 'role'])->findOrFail($id);
        $positions = Position::all();
        $sections = Section::all();
        $roles = Role::all();
        return view('forms.edit-pengguna', compact('user', 'positions', 'sections', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::with(['position', 'section', 'role'])->findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'section_id' => 'nullable|uuid|exists:sections,id',
            'position_id' => 'nullable|uuid|exists:positions,id',
            'role_id' => 'nullable|uuid|exists:roles,id',
        ];
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules, [
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
            'username.unique' => 'Username sudah terdaftar, gunakan username lain.',
            'section_id.exists' => 'Bagian yang dipilih tidak valid.',
            'position_id.exists' => 'Jabatan yang dipilih tidak valid.',
            'role_id.exists' => 'Hak akses yang dipilih tidak valid.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'section_id' => $request->section_id,
            'position_id' => $request->position_id,
            'role_id' => $request->role_id,
        ];
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = User::with(['position', 'section', 'role'])->findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
