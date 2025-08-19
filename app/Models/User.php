<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Hash;
use App\Models\UserToken;



class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'position_id',
        'section_id',
        'username',
        'role_id',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::created(function (self $user) {
            $plainToken = Str::random(64);
            $hashedToken = Hash::make($plainToken);

            UserToken::create([
                'user_id' => $user->id,
                'token' => $hashedToken,
                'type' => 'Aktivasi',
                'is_used' => false,
                'expired_at' => now()->addMinutes(30),
            ]);
        });
    }

    public function tokens()
    {
        return $this->hasMany(UserToken::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
