<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExecutiveCommittee extends Model
{
    protected $fillable = [
        'year',
        'document_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
