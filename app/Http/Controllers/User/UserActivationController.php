<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserActivationController extends Controller
{
    public function index()
    {
        $users = User::with(['position', 'section', 'role'])->latest()->get();
        return view('contents.user-activation', compact('users'));
    }

    public function toggleActivation(User $user)
    {
        try {
            $user->is_active = !$user->is_active;
            $user->save();

            $message = $user->is_active ? 'Pengguna berhasil diaktifkan.' : 'Pengguna berhasil dinonaktifkan.';

            return redirect()->route('users.activation.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('users.activation.index')->with('error', 'Terjadi kesalahan saat mengubah status pengguna.');
        }
    }
}
