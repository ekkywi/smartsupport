<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserActivationController;
use App\Http\Controllers\User\UserTokenController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Activation
Route::get('/aktivasi', [ActivationController::class, 'index'])->name('activation.index');
Route::post('/aktivasi', [ActivationController::class, 'activation'])->name('activation');

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User
    Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');
    Route::get('/pengguna/tambah', [UserController::class, 'create'])->name('users.create');
    Route::post('/pengguna', [UserController::class, 'store'])->name('users.store');
    Route::get('/pengguna/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/pengguna/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Activation
    Route::get('/aktivasi-pengguna', [UserActivationController::class, 'index'])->name('users.activation.index');
    Route::patch('/aktivasi-pengguna/{user}', [UserActivationController::class, 'toggleActivation'])->name('users.activation.toggle');

    // User Token
    Route::get('/token-pengguna', [UserTokenController::class, 'index'])->name('users.token.index');
    Route::get('/token-pengguna/{user}/tokens', [UserTokenController::class, 'show'])->name('users.token.show');
    Route::post('/token-pengguna/{user}/tokens/generate', [UserTokenController::class, 'generateToken'])->name('users.token.generate');
});
