<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Auth\Events\Login;

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User
Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');
Route::get('/pengguna/tambah', [UserController::class, 'create'])->name('users.create');
Route::post('/pengguna', [UserController::class, 'store'])->name('users.store');
Route::get('/pengguna/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/pengguna/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('users.destroy');
