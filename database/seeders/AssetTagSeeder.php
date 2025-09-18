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
                'name' => 'HDD',
                'asset_tag' => 'SHD',
                'description' => 'Media penyimpanan data (Hard Disk Drive)'
            ],
            [
                'name' => 'SSD',
                'asset_tag' => 'SSD',
                'description' => 'Solid State Drive (SSD)'
            ],
            [
                'name' => 'FlashDrive',
                'asset_tag' => 'SFD',
                'description' => 'Flash Drive (SFD)'
            ],
            [
                'name' => 'SDCard',
                'asset_tag' => 'SDC',
                'description' => 'Secure Digital Card (SD Card)'
            ],
            [
                'name' => 'MicroSD',
                'asset_tag' => 'SMS',
                'description' => 'Micro Secure Digital Card (MicroSD)'
            ],
            [
                'name' => 'Motherboard',
                'asset_tag' => 'M',
                'description' => 'Papan induk komputer'
            ],
            [
                'name' => 'PowerSupply',
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
