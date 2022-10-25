<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['deleted_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
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
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
    }
}
