<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtractedVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $appends = ['video_url', 'thumbnail_url'];
    public function scopeSearch($query, $request)
    {
        $query->when($request->user_id, function ($q, $user_id) {
            $q->where('user_id', '=', $user_id);
        });
    }
}
