<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityInfo extends Model
{
    protected $fillable = [
        'university_history',
        'university_mission',
        'university_vision',
        'batch_info',
        'university_main_photo_path',
        'university_detail_photo_1_path',
        'university_detail_photo_2_path',
        'university_detail_photo_3_path',
        'university_detail_photo_4_path',
        'university_detail_photo_5_path',
        'batch_detail_photo_1_path',
        'batch_detail_photo_2_path',
        'batch_detail_photo_3_path',
        'batch_detail_photo_4_path',
        'batch_detail_photo_5_path',
    ];
}
