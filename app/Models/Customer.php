<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
