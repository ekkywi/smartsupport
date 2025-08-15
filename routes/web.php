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
Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('/pengguna/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/pengguna/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/pengguna/aktivasi', [UserController::class, 'showActivation'])->name('users.activation');
Route::patch('/pengguna/aktivasi/{id}', [UserController::class, 'activate'])->name('users.activation.toggle');
