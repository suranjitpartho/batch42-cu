<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniMembership extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'membership_type',
        'transaction_id',
        'payment_method',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
