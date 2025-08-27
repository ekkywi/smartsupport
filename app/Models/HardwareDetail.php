<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'asset_tag',
        'serial_number',
        'model_id',
        'warranty_expires_at'
    ];

    protected function cast(): array
    {
        return [
            'warranty_expires_at' => 'datetime',
        ];
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function model()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }
}
