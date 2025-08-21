<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserToken;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|exists:users,username',
                'token' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'username.exists' => 'Username tidak ditemukan.',
                'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]
        );

        $userToken = UserToken::where('type', 'Reset')
            ->where('is_used', false)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', $request->username);
            })
            ->latest()
            ->first();

        if ($userToken && Hash::check($request->token, $userToken->token)) {

            if ($userToken->expired_at && $userToken->expired_at->isPast()) {
                return back()->with('error', 'Token reset password sudah kadaluwarsa.');
            }

            $user = $userToken->user;
            $user->update(['password' => $request->password]);
            $userToken->update(['is_used' => true]);

            return redirect()->route('login.index')->with('success', 'Password berhasil direset. Silahkan login dengan password baru.');
        }

        return back()->with('error', 'Token yang anda masukan salah atau sudah tidak valid.');
    }
}
