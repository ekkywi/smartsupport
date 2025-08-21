<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserToken;
use Illuminate\Support\Facades\Log;

class ActivationController extends Controller
{
    public function index()
    {
        return view('auth.activation');
    }

    public function activation(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|exists:users,username',
                'token' => 'required|string',
            ],
            [
                'username.exists' => 'Username tidak ditemukan.',
            ]
        );

        $userToken = UserToken::where('type', 'Aktivasi')
            ->where('is_used', false)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', $request->username);
            })
            ->latest()
            ->first();

        if ($userToken && Hash::check($request->token, $userToken->token)) {

            if ($userToken->expired_at && $userToken->expired_at->isPast()) {
                return back()->with('error', 'Token aktivasi sudah kadaluwarsa.');
            }

            $user = $userToken->user;
            $user->update(['is_active' => true]);
            $userToken->update(['is_used' => true]);

            return redirect()->route('login.index')->with('success', 'Akun berhasil diaktivasi. Silahkan login.');
        }

        Log::info('Token input:', [$request->token]);
        Log::info('Token hash:', [$userToken->token]);
        Log::info('Hash check:', [Hash::check($request->token, $userToken->token)]);

        return back()->with('error', 'Token yang anda masukan salah atau sudah tidak valid.');
    }
}
