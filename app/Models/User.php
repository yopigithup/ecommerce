<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;


    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';





    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'avatar',
        'avatar_url',
        'bio',
        'password',
        'email_verified_at',
        'is_admin',
        'role',
    ];

    // protected $guarded = ['id', 'is_admin'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
