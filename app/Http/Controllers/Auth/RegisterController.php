<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $positions = Position::all();
        $sections = Section::all();
        return view('auth.register', compact('positions', 'sections'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'section' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'section' => $request->section,
            'position' => $request->position,
            'password' => $request->password,
        ]);

        return redirect()->route('login')->with('success', 'Registerasi berhasil, silahkan aktivasi akun anda.');
    }
}
