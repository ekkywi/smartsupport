<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetStatus;

class AssetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assetStatuses = [
            [
                'name' => 'Tersedia',
                'asset_status_tag' => 'Tersedia',
                'description' => 'Aset tersedia untuk digunakan'
            ],
            [
                'name' => 'Digunakan',
                'asset_status_tag' => 'Digunakan',
                'description' => 'Aset sedang digunakan oleh pengguna'
            ],
            [
                'name' => 'Rusak',
                'asset_status_tag' => 'Rusak',
                'description' => 'Aset dalam kondisi rusak'
            ],
            [
                'name' => 'Dipinjam',
                'asset_status_tag' => 'Dipinjam',
                'description' => 'Aset sedang dipinjam oleh pengguna'
            ],
            [
                'name' => 'Dalam Perbaikan',
                'asset_status_tag' => 'Dalam Perbaikan',
                'description' => 'Aset sedang dalam proses perbaikan'
            ],
            [
                'name' => 'Dihapus',
                'asset_status_tag' => 'Dihapus',
                'description' => 'Aset telah dihapus dari inventaris'
            ],
        ];

        foreach ($assetStatuses as $status) {
            AssetStatus::updateOrCreate(
                ['name' => $status['name']],
                [
                    'asset_status_tag' => $status['asset_status_tag'],
                    'description' => $status['description']
                ]
            );
        }
    }
}
