<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public static function routeName()
    {
        return Str::snake("PasswordReset");
    }
    public function store(PasswordResetRequest $request)
    {
        $response = $this->user->update(['password' => Hash::make($request->new_password)]);
        return new UserResource($response);
    }
}
