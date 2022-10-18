<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class EditedVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $appends = ['video_url', 'thumbnail_url'];
    protected $with = ['keywords'];
    public function getVideoUrlAttribute()
    {
        if ($this->url)
            return  env('APP_URL') .  '/storage/' . $this->url;
        return null;
    }
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail)
            return env('APP_URL') .  '/storage/' . $this->thumbnail;
        return null;
    }
    public function keywords()
    {
        return $this->hasMany(EditedVideosKeywords::class, 'edited_video_id');
    }
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
        if ($request->user_id) {
            $query->where('user_id', '=', $request->user_id);
        }
    }
}
