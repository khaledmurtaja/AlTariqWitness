<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserLogoController extends Controller
{
    public static function routeName()
    {
        return Str::snake("UserLogo");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function store(Request $request)
    {
        $file = request('file');
        $user = User::find(auth()->user()->id);
        if ($file) {
            Storage::disk('public')->delete($user->logo);
            $mimetype = $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $user->update(['logo' => $path]);
        }
        return new UserResource($user);
    }
}
