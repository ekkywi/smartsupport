<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            Permission::all()->each(function ($permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->role->permissions->contains($permission);
                });
            });
        } catch (\Exception $e) {
            Log::error('Error defining gates: ' . $e->getMessage());
        }
    }
}
