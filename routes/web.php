<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\AssetStatus\AssetStatusController;
use App\Http\Controllers\SystemLog\AssetStatusLogController;
use App\Http\Controllers\Component\ComponentTypeController;
use App\Http\Controllers\Hardware\HardwareTypeController;
use App\Http\Controllers\SupplierVendor\BrandController;
use App\Http\Controllers\SupplierVendor\SupplierController;
use App\Http\Controllers\SupplierVendor\VendorController;
use App\Http\Controllers\AssetNumber\AssetTagController;

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

    // Asset Tag Master Data
    Route::middleware(['auth', 'can:manage_asset_numberings'])->group(function () {
        Route::get('/tag-aset', [AssetTagController::class, 'index'])->name('asset.tags.index');
        Route::get('/tag-aset/tambah', [AssetTagController::class, 'create'])->name('asset.tags.create');
        Route::post('/tag-aset', [AssetTagController::class, 'store'])->name('asset.tags.store');
        Route::get('/tag-aset/{assetTag}/edit', [AssetTagController::class, 'edit'])->name('asset.tags.edit');
        Route::put('/tag-aset/{assetTag}', [AssetTagController::class, 'update'])->name('asset.tags.update');
        Route::delete('/tag-aset/{assetTag}', [AssetTagController::class, 'destroy'])->name('asset.tags.destroy');
        Route::get('/tag-aset/trash', [AssetTagController::class, 'trashed'])->name('asset.tags.trashed');
        Route::post('/tag-aset/{id}/restore', [AssetTagController::class, 'restore'])->name('asset.tags.restore');
        Route::delete('/tag-aset/{id}/force-delete', [AssetTagController::class, 'forceDelete'])->name('asset.tags.force.delete');
    });

    // Asset Status Master Data
    Route::middleware(['auth', 'can:manage_asset_statuses'])->group(function () {
        Route::get('/aset-status', [AssetStatusController::class, 'index'])->name('asset.status.index');
        Route::get('/aset-status/tambah', [AssetStatusController::class, 'create'])->name('asset.status.create');
        Route::post('/aset-status', [AssetStatusController::class, 'store'])->name('asset.status.store');
        Route::get('/aset-status/{assetStatus}/edit', [AssetStatusController::class, 'edit'])->name('asset.status.edit');
        Route::put('/aset-status/{assetStatus}', [AssetStatusController::class, 'update'])->name('asset.status.update');
        Route::delete('/aset-status/{assetStatus}', [AssetStatusController::class, 'destroy'])->name('asset.status.destroy');
        Route::get('/aset-status/trash', [AssetStatusController::class, 'trashed'])->name('asset.status.trashed');
        Route::post('/aset-status/{id}/restore', [AssetStatusController::class, 'restore'])->name('asset.status.restore');
        Route::delete('/aset-status/{id}/force-delete', [AssetStatusController::class, 'forceDelete'])->name('asset.status.force.delete');
    });

    // Component Master Data
    Route::middleware(['auth', 'can:manage_asset_components'])->group(function () {
        Route::get('/tipe-komponen', [ComponentTypeController::class, 'index'])->name('component.types.index');
        Route::get('/tipe-komponen/tambah', [ComponentTypeController::class, 'create'])->name('component.types.create');
        Route::post('/tipe-komponen', [ComponentTypeController::class, 'store'])->name('component.types.store');
        Route::get('/tipe-komponen/{componentType}/edit', [ComponentTypeController::class, 'edit'])->name('component.types.edit');
        Route::put('/tipe-komponen/{componentType}', [ComponentTypeController::class, 'update'])->name('component.types.update');
        Route::delete('/tipe-komponen/{componentType}', [ComponentTypeController::class, 'destroy'])->name('component.types.destroy');
        Route::get('/tipe-komponen/trash', [ComponentTypeController::class, 'trashed'])->name('component.types.trashed');
        Route::post('/tipe-komponen/{id}/restore', [ComponentTypeController::class, 'restore'])->name('component.types.restore');
        Route::delete('/tipe-komponen/{id}/force-delete', [ComponentTypeController::class, 'forceDelete'])->name('component.types.force.delete');
    });

    // Hardware Master Data
    Route::middleware(['auth', 'can:manage_asset_hardwares'])->group(function () {
        Route::get('/tipe-hardware', [HardwareTypeController::class, 'index'])->name('hardware.types.index');
        Route::get('/tipe-hardware/tambah', [HardwareTypeController::class, 'create'])->name('hardware.types.create');
        Route::post('/tipe-hardware', [HardwareTypeController::class, 'store'])->name('hardware.types.store');
        Route::get('/tipe-hardware/{hardwareType}/edit', [HardwareTypeController::class, 'edit'])->name('hardware.types.edit');
        Route::put('/tipe-hardware/{hardwareType}', [HardwareTypeController::class, 'update'])->name('hardware.types.update');
        Route::delete('/tipe-hardware/{hardwareType}', [HardwareTypeController::class, 'destroy'])->name('hardware.types.destroy');
        Route::get('/tipe-hardware/trash', [HardwareTypeController::class, 'trashed'])->name('hardware.types.trashed');
        Route::post('/tipe-hardware/{id}/restore', [HardwareTypeController::class, 'restore'])->name('hardware.types.restore');
        Route::delete('/tipe-hardware/{id}/force-delete', [HardwareTypeController::class, 'forceDelete'])->name('hardware.types.force.delete');
    });

    // Brand and Supplier Master Data
    Route::middleware(['auth', 'can:manage_suppliers_and_vendors'])->group(function () {
        // Brand
        Route::get('/merek', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/merek/tambah', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/merek', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/merek/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/merek/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/merek/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        Route::get('/merek/trash', [BrandController::class, 'trashed'])->name('brands.trashed');
        Route::post('/merek/{id}/restore', [BrandController::class, 'restore'])->name('brands.restore');
        Route::delete('/merek/{id}/force-delete', [BrandController::class, 'forceDelete'])->name('brands.force.delete');

        // Supplier
        Route::get('/supplier', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/supplier/tambah', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        Route::get('/supplier/trash', [SupplierController::class, 'trashed'])->name('suppliers.trashed');
        Route::post('/supplier/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
        Route::delete('/supplier/{id}/force-delete', [SupplierController::class, 'forceDelete'])->name('suppliers.force.delete');

        // Vendor
        Route::get('/vendor', [VendorController::class, 'index'])->name('vendors.index');
        Route::get('/vendor/tambah', [VendorController::class, 'create'])->name('vendors.create');
        Route::post('/vendor', [VendorController::class, 'store'])->name('vendors.store');
        Route::get('/vendor/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::put('/vendor/{vendor}', [VendorController::class, 'update'])->name('vendors.update');
        Route::delete('/vendor/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy');
        Route::get('/vendor/trash', [VendorController::class, 'trashed'])->name('vendors.trashed');
        Route::post('/vendor/{id}/restore', [VendorController::class, 'restore'])->name('vendors.restore');
        Route::delete('/vendor/{id}/force-delete', [VendorController::class, 'forceDelete'])->name('vendors.force.delete');
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

        // User Token
        Route::get('/token-pengguna', [TokenController::class, 'index'])->name('users.token.index');
        Route::get('/token-pengguna/{user}/tokens', [TokenController::class, 'show'])->name('users.token.show');
        Route::post('/token-pengguna/{user}/tokens/generate', [TokenController::class, 'generateToken'])->name('users.token.generate');
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
    Route::middleware(['auth', 'can:manage_administrations_and_accesses'])->group(function () {
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

    // System Log
    Route::middleware(['auth'])->group(function () {
        // Asset Status Log
        Route::get('/log-status-aset', [AssetStatusLogController::class, 'index'])->name('asset.status.log.index');
    });
});
