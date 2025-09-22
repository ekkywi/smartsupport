<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class ComponentModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'component_model_code',
        'component_type_id',
        'brand_id',
        'specs',
        'description',
    ];

    protected $casts = [
        'specs' => 'array',
    ];

    protected function formattedSpecs(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->specs)) {
                    return [];
                }

                $formatted = [];
                foreach ($this->specs as $key => $value) {
                    $formatted[] = [
                        'label' => Str::headline($key),
                        'value' => $value,
                    ];
                }
                return $formatted;
            }
        );
    }

    public function componentType()
    {
        return $this->belongsTo(ComponentType::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
