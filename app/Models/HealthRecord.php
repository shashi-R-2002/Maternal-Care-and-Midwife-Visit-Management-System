<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'visit_id',
        'mother_id',
        'blood_pressure',
        'weight',
        'blood_sugar',
        'hemoglobin',
        'urine_protein',
        'urine_sugar',
        'notes',
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}