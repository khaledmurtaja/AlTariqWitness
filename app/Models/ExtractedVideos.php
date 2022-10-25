<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtractedVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $appends = ['video_url', 'thumbnail_url'];
}
