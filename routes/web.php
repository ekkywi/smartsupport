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

Route::get('/data-pengguna', [UserController::class, 'index'])->name('data-pengguna');
Route::get('/tambah-pengguna', [UserController::class, 'showAddUserForm'])->name('tambah-pengguna');
