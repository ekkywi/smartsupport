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
Route::get('/activation', [ActivationController::class, 'index'])->name('activation.index');
Route::post('/activation', [ActivationController::class, 'activation'])->name('activation');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User
    Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');
    Route::get('/pengguna/tambah', [UserController::class, 'create'])->name('users.create');
    Route::post('/pengguna', [UserController::class, 'store'])->name('users.store');
    Route::get('/pengguna/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/pengguna/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Activation
    Route::get('/activation', [UserActivationController::class, 'index'])->name('users.activation.index');
    Route::patch('/activation/{user}', [UserActivationController::class, 'toggleActivation'])->name('users.activation.toggle');
});
