<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', 'Akun Anda belum aktif. Silakan cek email untuk aktivasi.');
            }
        }

        return back()->with('error', 'Username atau password yang Anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
