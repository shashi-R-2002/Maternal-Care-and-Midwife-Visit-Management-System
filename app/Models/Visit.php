<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visit extends Model
{
    protected $fillable = [
        'mother_id',
        'midwife_id',
        'visit_date',
        'next_visit_date',
        'visit_type',
        'blood_pressure',
        'weight',
        'notes',
    ];

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Mother::class);
    }

    public function midwife(): BelongsTo
    {
        return $this->belongsTo(Midwife::class);
    }

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }

    public function nutritionRecords(): HasMany
    {
        return $this->hasMany(NutritionRecord::class);
    }
}