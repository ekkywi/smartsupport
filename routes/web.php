<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/pengguna', [UserController::class, 'index'])->name('users');
Route::get('/pengguna/tambah', [UserController::class, 'showAddUserForm'])->name('users.add');
Route::post('/pengguna/tambah', [UserController::class, 'store'])->name('users.store');
