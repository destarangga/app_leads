<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'name',
        'phone',
        'origin',
        'address',
        'taken_by_salesman', 
        'salesman_id',
    ];

    /**
     * Mendapatkan salesman yang mengambil lead.
     */
    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id'); 
    }

    /**
     * Mendapatkan histori follow-up untuk lead ini.
     */
    public function histories()
    {
        return $this->hasMany(LeadHistory::class); 
    }

    /**
     * Mendapatkan status apakah lead sudah diambil oleh salesman.
     */
    public function isTakenBySalesman()
    {
        return $this->taken_by_salesman ? 'Taken' : 'Not Taken';
    }
}
