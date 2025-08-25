<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('name')->get();
        return view('contents.administration-role-data', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('forms.administration-role-create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:roles,name',
                'role_code' => 'required|string|max:255|unique:roles,role_code'
            ],
            [
                'name.required' => 'Nama peran harus diisi.',
                'role_code.required' => 'Kode peran harus diisi.',
                'name.unique' => 'Nama peran sudah terdaftar.',
                'role_code.unique' => 'Kode peran sudah terdaftar.'
            ]
        );
        $role = Role::create([
            'name' => $request->name,
            'role_code' => $request->role_code
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Peran berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('forms.administration-role-edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'role_code' => 'required|string|max:255|unique:roles,role_code,' . $role->id,
                'permissions' => 'nullable|array',
            ],
            [
                'name.required' => 'Nama peran harus diisi.',
                'role_code.required' => 'Kode peran harus diisi.',
                'name.unique' => 'Nama peran sudah terdaftar.',
                'role_code.unique' => 'Kode peran sudah terdaftar.'
            ]
        );

        $role->update([
            'name' => $request->name,
            'role_code' => $request->role_code

        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Peran berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Peran berhasil dihapus.');
    }
}
