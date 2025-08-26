<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Administrator')->first();

        if (!$adminRole) {
            $this->command->error('Role "Admin" tidak ditemukan. Pastikan RoleSeeder sudah dijalankan.');
            return;
        }

        $allPermissionIds = Permission::pluck('id');

        $adminRole->permissions()->sync($allPermissionIds);

        $this->command->info('Semua hak akses telah diberikan kepada role Administrator.');

        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'role_id' => $adminRole->id,
                'password' => 'admin123',
                'is_active' => true,
            ]
        );
    }
}
