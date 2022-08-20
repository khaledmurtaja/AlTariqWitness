<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class EditedVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $appends = ['video_url'];

    public function getUrlAttribute()
    {
        return env('APP_URL') . Storage::url($this->url);
    }
}
