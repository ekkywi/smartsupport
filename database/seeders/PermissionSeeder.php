<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'manage_assets',
                'code_name' => 'Manage Assets',
                'description' => 'Mengelola data aset (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan kategori/merk aset'
            ],
            [
                'name' => 'manage_users',
                'code_name' => 'Manage Users',
                'description' => 'Mengelola data pengguna (CRUD) - Dapat melakukan penambahan, pengeditan, penghapusan, dan aktivasi pengguna'
            ],
            [
                'name' => 'manage_organizations',
                'code_name' => 'Manage Organizations',
                'description' => 'Mengelola data organisasi (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan bagian/jabatan'
            ],
            [
                'name' => 'manage_tokens',
                'code_name' => 'Manage Tokens',
                'description' => 'Mengelola data token - Dapat melakukan generate token aktivasi dan token reset password'
            ],
            [
                'name' => 'manage_administrations',
                'code_name' => 'Manage Administrations',
                'description' => 'Mengelola data administrasi (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan data peran. Dapat mengatur hak akses peran'
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'code_name' => $permission['code_name'],
                    'description' => $permission['description']
                ]
            );
        }
    }
}
