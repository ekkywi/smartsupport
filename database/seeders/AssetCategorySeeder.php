<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetCategory;

class AssetCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Komputer Desktop'],
            ['name' => 'Laptop'],
            ['name' => 'Monitor'],
            ['name' => 'Printer'],
        ];
        foreach ($categories as $category) {
            AssetCategory::updateOrCreate(
                [
                    'name' => $category['name']
                ]
            );
        }
    }
}
