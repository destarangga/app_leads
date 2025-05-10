<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fields',
        'criteria',
    ];

    protected $casts = [
        'fields' => 'array',
        'criteria' => 'array',
    ];
}
