<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetBrand;

class AssetBrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'HP'],
            ['name' => 'Dell'],
            ['name' => 'Lenovo'],
            ['name' => 'Logitech'],
        ];
        foreach ($brands as $brand) {
            AssetBrand::updateOrCreate(
                [
                    'name' => $brand['name']
                ]
            );
        }
    }
}
