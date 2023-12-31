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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    protected $appends = ['logo_url', 'user_type_name'];
    public function getLogoUrlAttribute()
    {
        return env('APP_URL')  .  '/storage/' . $this->logo;
    }
    public function getUserTypeNameAttribute()
    {
        $types = [
            __("Mobile"),
            __("Web"),
        ];
        return  $types[(int) $this->type - 1] ?? '';
    }
    public function scopeSort($query, $request)
    {
    }
    public function scopeSearch($query, $request)
    {
        $query->when($request->status, function ($query, $status) {
            $query->whereIn('status', $status);
        })->when($request->user_name, function ($query, $user_name) {
            $query->where('user_name', '=', $user_name);
        })->when($request->email, function ($query, $email) {
            $query->where('email', '=', $email);
        })->when($request->mobile, function ($query, $mobile) {
            $query->where('mobile', '=', $mobile);
        })->orderBy('created_at', 'desc');
    }
}
