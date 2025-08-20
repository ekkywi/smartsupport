<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserToken;

class ActivationController extends Controller
{
    public function index()
    {
        return view('auth.activation');
    }

    public function activation(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'token' => 'required|string',
        ], [
            'username.required' => 'Username harus diisi.',
            'token.required' => 'Token harus diisi.',
            'username.exists' => 'Username tidak ditemukan.',
        ]);

        $userToken = UserToken::where('type', 'Aktivasi')
            ->where('is_used', false)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('username', $request->username);
            })
            ->first();

        if ($userToken && Hash::check($request->token, $userToken->token)) {
            if (now()->isAfter($userToken->expire_at)) {
                return back()->with('error', 'Token aktivasi sudah kadaluwarsa.');
            }

            $user = $userToken->user;
            $user->update(['is_active' => true]);
            $userToken->update(['is_used' => true]);

            return redirect()->route('login.index')->with('success', 'Akun berhasil diaktivasi. Silahkan login.');
        }

        return back()->with('error', 'Token yang anda masukan salah atau sudah tidak valid.');
    }
}
