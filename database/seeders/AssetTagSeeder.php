<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetTag;

class AssetTagSeeder extends Seeder
{
    public function run(): void
    {
        $assetTags = [
            [
                'name' => 'RAM',
                'asset_tag' => 'R',
                'description' => 'Random Access Memory (RAM)'
            ],
            [
                'name' => 'Hard Disk',
                'asset_tag' => 'H',
                'description' => 'Hard Disk Drive (HDD)'
            ],
            [
                'name' => 'SSD',
                'asset_tag' => 'S',
                'description' => 'Solid State Drive (SSD)'
            ],
            [
                'name' => 'Motherboard',
                'asset_tag' => 'M',
                'description' => 'Papan induk komputer'
            ],
            [
                'name' => 'Power Supply',
                'asset_tag' => 'P',
                'description' => 'Unit catu daya komputer'
            ],
            [
                'name' => 'CPU',
                'asset_tag' => 'C',
                'description' => 'Central Processing Unit (CPU)'
            ],
            [
                'name' => 'GPU',
                'asset_tag' => 'G',
                'description' => 'Graphics Processing Unit (GPU)'
            ]
        ];

        foreach ($assetTags as $assetTag) {
            AssetTag::updateOrCreate(
                ['name' => $assetTag['name']],
                [
                    'asset_tag' => $assetTag['asset_tag'],
                    'description' => $assetTag['description']
                ]
            );
        }
    }
}
