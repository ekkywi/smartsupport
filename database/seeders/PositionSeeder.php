<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['position_code' => 'MNG', 'name' => 'Manager'],
            ['position_code' => 'KBG', 'name' => 'Kepala Bagian'],
            ['position_code' => 'SPV', 'name' => 'Supervisor'],
            ['position_code' => 'STF', 'name' => 'Staff']
        ];

        foreach ($positions as $position) {
            Position::updateOrCreate(
                ['position_code' => $position['position_code']],
                ['name' => $position['name']]
            );
        }
    }
}
