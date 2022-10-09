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
        $user = User::find(Auth::id());
        $user = $user->update(['password' => Hash::make($request->new_password)]);
        return response()->json(['message' => __("passwords.reset")], 200);
    }
}
