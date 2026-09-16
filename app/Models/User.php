<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'role',
];

protected $hidden = [
    'password',
    'remember_token',
];
    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function midwife(): HasOne
    {
        return $this->hasOne(Midwife::class);
    }

    public function mother(): HasOne
    {
        return $this->hasOne(Mother::class);
    }
}