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
            ['name' => 'Komputer Desktop', 'category_tag' => 'W'],
            ['name' => 'Laptop', 'category_tag' => 'L'],
            ['name' => 'Monitor', 'category_tag' => 'M'],
            ['name' => 'Printer', 'category_tag' => 'P'],
        ];

        foreach ($categories as $category) {
            AssetCategory::updateOrCreate(
                [
                    'name' => $category['name'],
                    'category_tag' => $category['category_tag']
                ]
            );
        }
    }
}
