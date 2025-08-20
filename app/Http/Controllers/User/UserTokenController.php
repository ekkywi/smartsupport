<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserTokenController extends Controller
{
    public function index()
    {
        $users = User::with(['position', 'role', 'section', 'tokens'])
            ->latest()
            ->get();

        return view('contents.user-token', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['tokens'])->findOrFail($id);
        return view('contents.user-token-detail', compact('user'));
    }

    public function generateToken(Request $request, User $user)
    {
        $request->validate(['type' => 'required|in:Aktivasi,Reset']);
        $tokenType = $request->type;

        $user->tokens()
            ->where('type', $tokenType)
            ->where('is_used', false)
            ->update(['expired_at' => now()]);

        $plainToken = Str::random(64);
        $hashedToken = Hash::make($plainToken);

        $user->tokens()->create([
            'token' => $hashedToken,
            'type' => $request->type,
            'expired_at' => ($request->type == 'Reset') ? now()->addMinutes(30) : now()->addHours(24),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Token ' . $request->type . ' baru berhasil dibuat!',
            'plain_token' => $plainToken
        ]);

        return back()->with('success', "Token {$tokenType} baru berhasil dibuat untuk {$user->name}.");
    }
}
