<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_dosis',
        'date',
        'status',
        'vaccine_id',
        'patient_id'
    ];
}
