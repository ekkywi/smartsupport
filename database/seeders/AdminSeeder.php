<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cari role "Admin" yang sudah dibuat oleh RoleSeeder
        $adminRole = Role::where('name', 'Administrator')->first();

        // Jika role Admin tidak ditemukan, hentikan seeder
        if (!$adminRole) {
            $this->command->error('Role "Admin" tidak ditemukan. Pastikan RoleSeeder sudah dijalankan.');
            return;
        }

        // 2. Buat atau perbarui user admin
        User::updateOrCreate(
            [
                'username' => 'admin', // Kunci unik untuk mencari user
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'role_id' => $adminRole->id, // Hubungkan dengan ID role Admin
                'password' => 'admin123', // Otomatis di-hash oleh cast di Model User
                'is_active' => true, // Langsung aktif
            ]
        );
    }
}
