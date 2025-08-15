<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('contents.data-pengguna', compact('users'));
    }

    public function showAddUserForm()
    {
        return view('forms.tambah-pengguna');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'position' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'position' => $request->input('position'),
            'section' => $request->input('section'),
            'username' => $request->input('username'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('forms.edit-pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'position' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role' => 'required|string|max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('users')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function showActivation()
    {
        $users = User::all();
        return view('contents.aktivasi-pengguna', compact('users'));
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('users.activation')->with('success', 'Pengguna ' . $user->name . ' berhasil ' . $status . '.');
    }
}
