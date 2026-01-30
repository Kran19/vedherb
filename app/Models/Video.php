<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'video_url',
        'description',
        'thumbnail_path',
        'status',
        'is_featured',
    ];
}
