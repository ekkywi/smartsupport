<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetStatus;

class AssetStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Tersedia'],
            ['name' => 'Sedang Digunakan'],
            ['name' => 'Dalam Perbaikan'],
            ['name' => 'Dihapus'],
        ];
        foreach ($statuses as $status) {
            AssetStatus::updateOrCreate(
                [
                    'name' => $status['name']
                ]
            );
        }
    }
}
