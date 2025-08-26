<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class AssetModel extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'category_id',
        'brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(AssetBrand::class);
    }
}
