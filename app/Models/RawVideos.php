<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawVideos extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $appends = ['video_url'];
    protected $with = ['tags'];

    public function getVideoUrlAttribute()
    {
        return 'http://91.232.125.244:8085' .  '/storage/' . $this->url;
    }
    public function tags()
    {
        return $this->hasMany(RawVideoTags::class, 'raw_video_id');
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
    // public static function file_get_contents_curl($url)
    // {
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     $data = curl_exec($ch);
    //     curl_close($ch);
    //     return $data;
    // }
}
