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
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active) {
                $request->session()->regenerate();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login Berhasil! Selamat Datang, ' . $user->name,
                    'redirect' => url('/dashboard')
                ]);
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun Anda belum aktif. Silakan lakukan proses aktivasi akun.'
                ], 401);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Username atau password yang Anda masukkan salah.'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
