<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\HardwareDetail;
use App\Models\SoftwareDetail;
use App\Models\DigitalService;
use Dom\Attr;

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

    protected function assetType(): Attribute
    {
        return Attribute::make(
            get: function () {
                switch ($this->assetable_type) {
                    case HardwareDetail::class:
                        return 'Hardware';
                    case SoftwareDetail::class:
                        return 'Software';
                    case DigitalService::class:
                        return 'Layanan Digital';
                    default:
                        return 'Tidak Diketahui';
                }
            },
        );
    }

    protected function assetTypeColor(): Attribute
    {
        return Attribute::make(
            get: function () {
                switch ($this->assetable_type) {
                    case HardwareDetail::class:
                        return 'success';
                    case SoftwareDetail::class:
                        return 'info';
                    case DigitalService::class:
                        return 'warning';
                    default:
                        return 'secondary';
                }
            },
        );
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
