<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetLocation;

class AssetLocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Gudang IT'],
            ['name' => 'Ruang IT']
        ];

        foreach ($locations as $location) {
            AssetLocation::updateOrCreate(
                [
                    'name' => $location['name']
                ]
            );
        }
    }
}
