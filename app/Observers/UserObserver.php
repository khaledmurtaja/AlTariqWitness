<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function creating(User $user)
    {
        if ($user->password)
            $user->password = Hash::make($user->password);
        $file = request('file');
        if ($file) {
            $mimetype = $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $user->logo = $path;
        }
    }
}
