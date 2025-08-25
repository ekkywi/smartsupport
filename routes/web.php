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
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Token\TokenController;
use App\Http\Controllers\Organization\SectionController;
use App\Http\Controllers\Organization\PositionController;
use App\Http\Controllers\Administration\RoleController;
use App\Http\Controllers\Administration\PermissionController;

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

// Reset Password
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');

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
    Route::get('/token-pengguna', [TokenController::class, 'index'])->name('users.token.index');
    Route::get('/token-pengguna/{user}/tokens', [TokenController::class, 'show'])->name('users.token.show');
    Route::post('/token-pengguna/{user}/tokens/generate', [TokenController::class, 'generateToken'])->name('users.token.generate');

    // Section
    Route::get('/bagian', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/bagian/tambah', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/bagian', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/bagian/{id}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/bagian/{id}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/bagian/{id}', [SectionController::class, 'destroy'])->name('sections.destroy');

    // Position
    Route::get('/jabatan', [PositionController::class, 'index'])->name('positions.index');
    Route::get('/jabatan/tambah', [PositionController::class, 'create'])->name('positions.create');
    Route::post('/jabatan', [PositionController::class, 'store'])->name('positions.store');
    Route::get('/jabatan/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/jabatan/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/jabatan/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');

    // Role
    Route::get('/peran', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/peran/tambah', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/peran', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/peran/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/peran/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/peran/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permission
    Route::get('/hak-akses', [PermissionController::class, 'index'])->name('permissions.index');
});
