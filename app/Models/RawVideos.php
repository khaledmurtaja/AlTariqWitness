<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    public static $is_logged = true;
    protected $appends = ['video_url', 'thumbnail_url'];
    protected $with = ['tags'];
    public function tags()
    {
        return $this->hasMany(RawVideoTags::class, 'raw_video_id');
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
