<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status', 'user_name', 'nationality', 'birth_date', 'mobile', 'logo'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at'
    ];
    protected $appends = ['image_url'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
        $query->when($request->status, function ($query, $status) {
            $query->whereIn('status', $status);
        })->orderBy('created_at', 'desc');
    }
    public function getImageUrlAttribute()
    {
        return env('APP_URL') . Storage::url($this->logo);
    }
}
