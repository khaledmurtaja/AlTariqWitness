<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeletedVideo extends BaseModel
{
    use HasFactory, SoftDeletes;
    public static $is_logged = true;
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
        $query->when($request->user_id, function ($q, $user_id) {
            $q->where('user_id', '=', $user_id);
        })->when($request->raw_video_id, function ($q, $raw_video_id) {
            $q->where('raw_video_id', '=', $raw_video_id);
        });
    }
}
