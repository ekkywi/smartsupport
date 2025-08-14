<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('contents.data-pengguna');
    }

    public function showAddUserForm()
    {
        return view('forms.tambah-pengguna');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users,email',
            'jabatan' => 'string|max:255',
            'section' => 'string|max:255',
            'username' => 'string|max:255|unique:users,username',
            'role' => 'string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'jabatan' => $request->input('jabatan'),
            'section' => $request->input('section'),
            'username' => $request->input('username'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('users')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
