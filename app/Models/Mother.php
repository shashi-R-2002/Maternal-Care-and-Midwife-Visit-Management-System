<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mother extends Model
{
    protected $fillable = [
        'user_id',
        'midwife_id',
        'registration_no',
        'full_name',
        'nic',
        'dob',
        'age',
        'phone',
        'address',
        'blood_group',
        'lmp',
        'edd',
        'gravida',
        'para',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(Midwife::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}