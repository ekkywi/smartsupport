<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('contents.administration-role-data', compact('roles'));
    }

    public function create()
    {
        return view('forms.administration-role-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'role_name' => 'required|string|max:255|unique:roles,name',
                'role_code' => 'required|string|max:255|unique:roles,role_code'
            ],
            [
                'role_name.required' => 'Nama peran harus diisi.',
                'role_code.required' => 'Kode peran harus diisi.',
                'role_name.unique' => 'Nama peran sudah terdaftar.',
                'role_code.unique' => 'Kode peran sudah terdaftar.'
            ]
        );
        $role = Role::create([
            'name' => $request->role_name,
            'role_code' => $request->role_code
        ]);

        return redirect()->route('roles.index')->with('success', 'Peran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('forms.administration-role-edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'role_name' => 'required|string|max:255|unique:roles,name,' . $id,
                'role_code' => 'required|string|max:255|unique:roles,role_code,' . $id
            ],
            [
                'role_name.required' => 'Nama peran harus diisi.',
                'role_code.required' => 'Kode peran harus diisi.',
                'role_name.unique' => 'Nama peran sudah terdaftar.',
                'role_code.unique' => 'Kode peran sudah terdaftar.'
            ]
        );

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->role_name,
            'role_code' => $request->role_code
        ]);

        return redirect()->route('roles.index')->with('success', 'Peran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Peran berhasil dihapus.');
    }
}
