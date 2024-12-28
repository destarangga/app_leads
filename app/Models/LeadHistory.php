<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'salesman_id',
        'follow_up_via',
        'follow_up_date',
        'status',
        'notes',
        'next_follow_up_date',
        'email',
        'address',
        'job',
        'hobby',
    ];

    /**
     * Get the lead associated with the history.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the salesman who performed the follow-up.
     */
    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }
}
