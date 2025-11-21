<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Constitution extends Model
{
    use HasTranslations;

    public $translatable = ['chapter_name', 'content'];

    protected $fillable = [
        'chapter_number',
        'chapter_name',
        'content',
        'is_active',
        'order',
    ];
}
