<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Midwife extends Model
{
    protected $fillable = [
        'user_id',
        'registration_no',
        'full_name',
        'nic',
        'phone',
        'email',
        'address',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mothers(): HasMany
    {
        return $this->hasMany(Mother::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}