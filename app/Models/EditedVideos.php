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
    public function keywords()
    {
        return $this->hasMany(EditedVideosKeywords::class, 'edited_video_id');
    }
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
        $query->when($request->user_id, function ($q, $user_id) {
            $q->where('user_id', '=', $user_id);
        });
    }
}
