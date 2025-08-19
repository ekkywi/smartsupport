<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Section;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        $sections = Section::all();
        return view('auth.register', compact('positions', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'section_id' => 'nullable|uuid|exists:sections,id',
                'position_id' => 'nullable|uuid|exists:positions,id',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'username.unique' => 'Username sudah digunakan, silahkan pilih username lain.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
                'section_id.exists' => 'Bagian yang dipilih tidak valid.',
                'position_id.exists' => 'Jabatan yang dipilih tidak valid.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'section_id' => $request->section_id,
            'position_id' => $request->position_id,
            'password' => $request->password,
        ]);

        return redirect()->route('login')->with('success', 'Registerasi berhasil, silahkan aktivasi akun anda.');
    }
}
