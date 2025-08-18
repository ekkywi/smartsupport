<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleList = [
            ['role_code' => 'User', 'name' => 'Pengguna'],
            ['role_code' => 'Editor', 'name' => 'Editor'],
            ['role_code' => 'Admin', 'name' => 'Administrator'],
        ];

        foreach ($roleList as $role) {
            Role::updateOrCreate(
                ['role_code' => $role['role_code']],
                ['name' => $role['name']]
            );
        }
    }
}
