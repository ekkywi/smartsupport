<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AssetStatusLog extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'asset_status_id',
        'action',
        'data',
    ];

    public function assetStatus()
    {
        return $this->belongsTo(AssetStatus::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
