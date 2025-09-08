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
                'name' => 'manage_asset_statuses',
                'code_name' => 'Kelola Status Aset',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data status aset (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan status aset'
            ],
            [
                'name' => 'manage_component_types',
                'code_name' => 'Kelola Jenis Komponen',
                'group' => 'Master Data Komponen',
                'description' => 'Mengelola data jenis komponen (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan jenis komponen'
            ],
            [
                'name' => 'manage_users',
                'code_name' => 'Kelola Pengguna',
                'group' => 'Manajemen Aplikasi',
                'description' => 'Mengelola data pengguna (CRUD) - Dapat melakukan penambahan, pengeditan, penghapusan, dan aktivasi pengguna'
            ],
            [
                'name' => 'manage_organizations',
                'code_name' => 'Kelola Organisasi',
                'group' => 'Manajemen Aplikasi',
                'description' => 'Mengelola data organisasi (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan bagian/jabatan'
            ],
            [
                'name' => 'manage_tokens',
                'code_name' => 'Kelola Token',
                'group' => 'Manajemen Aplikasi',
                'description' => 'Mengelola data token - Dapat melakukan generate token aktivasi dan token reset password'
            ],
            [
                'name' => 'manage_administrations',
                'code_name' => 'Kelola Administrasi',
                'group' => 'Manajemen Aplikasi',
                'description' => 'Mengelola data administrasi (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan data peran. Dapat mengatur hak akses peran'
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'code_name' => $permission['code_name'],
                    'group' => $permission['group'],
                    'description' => $permission['description']
                ]
            );
        }
    }
}
