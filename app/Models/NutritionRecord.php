<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionRecord extends Model
{
    protected $fillable = [
        'visit_id',
        'mother_id',
        'nutrition_name',
        'quantity',
        'remarks',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Mother::class);
    }
}