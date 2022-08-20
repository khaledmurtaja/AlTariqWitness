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
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
    }
}
