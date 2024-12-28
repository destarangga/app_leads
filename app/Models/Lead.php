<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes; // Menambahkan soft deletes

    protected $fillable = [
        'name',
        'phone',
        'origin',
        'address',
        'taken_by_salesman', // Status apakah lead sudah diambil atau belum
        'salesman_id', // ID salesman yang mengambil lead
    ];

    /**
     * Mendapatkan salesman yang mengambil lead.
     */
    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id'); // Relasi dengan model User
    }

    /**
     * Mendapatkan histori follow-up untuk lead ini.
     */
    public function histories()
    {
        return $this->hasMany(LeadHistory::class); // Relasi dengan LeadHistory
    }

    /**
     * Mendapatkan status apakah lead sudah diambil oleh salesman.
     */
    public function isTakenBySalesman()
    {
        return $this->taken_by_salesman ? 'Taken' : 'Not Taken';
    }
}
