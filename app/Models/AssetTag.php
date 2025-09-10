<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AssetTag extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = [
        'name',
        'asset_tag',
        'description',
    ];
}
