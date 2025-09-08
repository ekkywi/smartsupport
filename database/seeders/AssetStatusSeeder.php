<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AssetStatus;
use App\Models\AssetStatusLog;

class AssetStatusSeeder extends Seeder
{
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

        $user = User::first();

        foreach ($assetStatuses as $statusData) {

            $status = AssetStatus::create($statusData);

            AssetStatusLog::create([
                'user_id' => $user ? $user->id : null,
                'asset_status_id' => $status->id,
                'action' => 'created',
                'data' => json_encode([
                    'message' => 'Inisialisasi data status aset: ' . $status->name,
                    'name' => $status->name,
                    'asset_status_tag' => $status->asset_status_tag,
                    'description' => $status->description,
                ]),
            ]);
        }
    }
}
