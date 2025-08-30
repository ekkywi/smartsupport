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
use App\Http\Controllers\Asset\AssetController;
use App\Http\Controllers\Asset\AssetCategoryController;
use App\Http\Controllers\Asset\AssetBrandController;
use App\Http\Controllers\Asset\AssetStatusController;
use App\Http\Controllers\Asset\AssetLocationController;
use App\Http\Controllers\Asset\AssetModelController;

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

    // Asset Management
    Route::middleware(['auth', 'can:manage_assets'])->group(function () {
        // Asset
        Route::get('/aset', [AssetController::class, 'index'])->name('assets.index');
        Route::get('/aset/tambah', [AssetController::class, 'create'])->name('assets.create');
        Route::post('/aset', [AssetController::class, 'store'])->name('assets.store');
        Route::get('/aset/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/aset/{asset}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/aset/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');

        // Asset Categories
        Route::get('/kategori-aset', [AssetCategoryController::class, 'index'])->name('assets.category.index');
        Route::post('/kategori-aset', [AssetCategoryController::class, 'store'])->name('assets.category.store');
        Route::get('/kategori-aset/{asset_category}/edit', [AssetCategoryController::class, 'edit'])->name('assets.category.edit');
        Route::put('/kategori-aset/{asset_category}', [AssetCategoryController::class, 'update'])->name('assets.category.update');
        Route::delete('/kategori-aset/{asset_category}', [AssetCategoryController::class, 'destroy'])->name('assets.category.destroy');

        // Asset Brands
        Route::get('/merk-aset', [AssetBrandController::class, 'index'])->name('assets.brand.index');
        Route::post('/merk-aset', [AssetBrandController::class, 'store'])->name('assets.brand.store');
        Route::get('/merk-aset/{asset_brand}/edit', [AssetBrandController::class, 'edit'])->name('assets.brand.edit');
        Route::put('/merk-aset/{asset_brand}', [AssetBrandController::class, 'update'])->name('assets.brand.update');
        Route::delete('/merk-aset/{asset_brand}', [AssetBrandController::class, 'destroy'])->name('assets.brand.destroy');

        // Asset Models
        Route::get('/model-aset', [AssetModelController::class, 'index'])->name('assets.model.index');
        Route::get('/model-aset/tambah', [AssetModelController::class, 'create'])->name('assets.model.create');
        Route::post('/model-aset', [AssetModelController::class, 'store'])->name('assets.model.store');
        Route::get('/model-aset/{asset_model}/edit', [AssetModelController::class, 'edit'])->name('assets.model.edit');
        Route::put('/model-aset/{asset_model}', [AssetModelController::class, 'update'])->name('assets.model.update');
        Route::delete('/model-aset/{asset_model}', [AssetModelController::class, 'destroy'])->name('assets.model.destroy');

        // Asset Statuses
        Route::get('/status-aset', [AssetStatusController::class, 'index'])->name('assets.status.index');
        Route::post('/status-aset', [AssetStatusController::class, 'store'])->name('assets.status.store');
        Route::get('/status-aset/{asset_status}/edit', [AssetStatusController::class, 'edit'])->name('assets.status.edit');
        Route::put('/status-aset/{asset_status}', [AssetStatusController::class, 'update'])->name('assets.status.update');
        Route::delete('/status-aset/{asset_status}', [AssetStatusController::class, 'destroy'])->name('assets.status.destroy');

        // Asset Locations
        Route::get('/lokasi-aset', [AssetLocationController::class, 'index'])->name('assets.location.index');
        Route::post('/lokasi-aset', [AssetLocationController::class, 'store'])->name('assets.location.store');
        Route::get('/lokasi-aset/{asset_location}/edit', [AssetLocationController::class, 'edit'])->name('assets.location.edit');
        Route::put('/lokasi-aset/{asset_location}', [AssetLocationController::class, 'update'])->name('assets.location.update');
        Route::delete('/lokasi-aset/{asset_location}', [AssetLocationController::class, 'destroy'])->name('assets.location.destroy');
    });

    // User Management
    Route::middleware(['auth', 'can:manage_users'])->group(function () {
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
    });

    // Organization Management
    Route::middleware(['auth', 'can:manage_organizations'])->group(function () {
        // Section
        Route::get('/bagian', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/bagian/tambah', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/bagian', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/bagian/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('/bagian/{section}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/bagian/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');

        // Position
        Route::get('/jabatan', [PositionController::class, 'index'])->name('positions.index');
        Route::get('/jabatan/tambah', [PositionController::class, 'create'])->name('positions.create');
        Route::post('/jabatan', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/jabatan/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
        Route::put('/jabatan/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::delete('/jabatan/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
    });


    // Administration Management
    Route::middleware(['auth', 'can:manage_administrations'])->group(function () {
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

    // User Token Management
    Route::middleware(['auth', 'can:manage_tokens'])->group(function () {
        // User Token
        Route::get('/token-pengguna', [TokenController::class, 'index'])->name('users.token.index');
        Route::get('/token-pengguna/{user}/tokens', [TokenController::class, 'show'])->name('users.token.show');
        Route::post('/token-pengguna/{user}/tokens/generate', [TokenController::class, 'generateToken'])->name('users.token.generate');
    });
});
