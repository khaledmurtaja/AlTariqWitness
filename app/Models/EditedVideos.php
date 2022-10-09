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

    public function getVideoUrlAttribute()
    {
        return 'http://91.232.125.244:8085' .  '/storage/' . $this->url;
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
