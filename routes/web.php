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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User
Route::get('/pengguna', [UserController::class, 'index'])->name('users');
Route::get('/pengguna/tambah', [UserController::class, 'showAddUserForm'])->name('users.add');
Route::post('/pengguna/tambah', [UserController::class, 'store'])->name('users.store');
Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('/pengguna/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/pengguna/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/pengguna/aktivasi', [UserController::class, 'showActivation'])->name('users.activation');
Route::patch('/pengguna/aktivasi/{id}', [UserController::class, 'activate'])->name('users.activation.toggle');
