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
                'name' => 'manage_asset_numberings',
                'code_name' => 'Kelola Penomoran Aset',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data penomoran aset (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan penomoran aset'
            ],
            [
                'name' => 'manage_asset_statuses',
                'code_name' => 'Kelola Status Aset',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data status aset (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan status aset'
            ],
            [
                'name' => 'manage_asset_components',
                'code_name' => 'Kelola Komponen',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data komponen (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan komponen'
            ],
            [
                'name' => 'manage_suppliers_and_vendors',
                'code_name' => 'Kelola Supplier dan Vendor',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data supplier dan vendor (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan supplier dan vendor'
            ],
            [
                'name' => 'manage_asset_hardwares',
                'code_name' => 'Kelola Hardware',
                'group' => 'Master Data Aset',
                'description' => 'Mengelola data hardware (CRUD) - Dapat melakukan penambahan, pengeditan, dan penghapusan hardware'
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
                'name' => 'manage_administrations_and_accesses',
                'code_name' => 'Kelola Administrasi dan Akses',
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
