<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'status_id',
        'assigned_to_user_id',
        'location_id',
        'purchase_date',
        'notes',
        'assetable_id',
        'assetable_type'
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'date',
        ];
    }

    public function getAssetable()
    {
        switch ($this->assetable_type) {
            case \App\Models\HardwareDetail::class:
                return 'Hardware';
            case \App\Models\SoftwareDetail::class:
                return 'Software';
            case \App\Models\DigitalService::class:
                return 'Digital Service';
            default:
                return 'Unknown';
        }
    }

    public function assetable()
    {
        return $this->morphTo();
    }

    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }
}
