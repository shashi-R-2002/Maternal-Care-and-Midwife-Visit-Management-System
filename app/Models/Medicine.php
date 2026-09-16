<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'visit_id',
        'mother_id',
        'medicine_name',
        'dosage',
        'quantity',
        'remarks',
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