<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'slug',
        'is_published',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
