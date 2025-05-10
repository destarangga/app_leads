<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'tanggal',
        'nama',
        'nohp',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'tipe',
        'warna',
        'hargajual',
        'discount',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'hargajual' => 'float',
        'discount' => 'float',
    ];
}
