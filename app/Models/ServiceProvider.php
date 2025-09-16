<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'service_provider_code',
        'name',
        'contact_person',
        'phone',
        'email',
        'website',
        'address',
        'postal_code',
        'city',
        'province',
        'country',
        'notes',
    ];
}
