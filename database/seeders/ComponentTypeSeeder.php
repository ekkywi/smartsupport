<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComponentType;
use App\Models\AssetTag;

class ComponentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $componentsType = [
            'RAM' => 'Random Access Memory (RAM)',
            'HDD' => 'Hard Disk Drive (HDD)',
            'SSD' => 'Solid State Drive (SSD)',
            'FlashDrive' => 'Media penyimpanan portabel',
            'SDCard' => 'Kartu memori untuk perangkat elektronik',
            'MicroSD' => 'Kartu memori berukuran kecil',
            'Motherboard' => 'Papan induk komputer',
            'PowerSupply' => 'Unit catu daya komputer',
            'CPU' => 'Central Processing Unit (CPU)',
            'GPU' => 'Graphics Processing Unit (GPU)'
        ];

        foreach ($componentsType as $name => $description) {
            $assetTag = AssetTag::where('name', $name)->first();

            if ($assetTag) {
                ComponentType::updateOrCreate(
                    ['name' => $name],
                    [
                        'asset_tag_id' => $assetTag->id,
                        'description' => $description
                    ]
                );
            }
        }
        $this->command->info('ComponentType seeder berhasil dijalankan.');
    }
}
