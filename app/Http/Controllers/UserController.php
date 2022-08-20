<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{
      public static function routeName()
    {
        return Str::snake("User");
    }
    public function __construct(Request $request)
    {
        $this->except = ['store'];
        parent::__construct($request);
        if (auth()->user())
            $this->authorizeResource(User::class, Str::snake("User"));
    }
    public function index(Request $request)
    {
        return UserResource::collection(User::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return new UserResource($user);
    }
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return new UserResource($user);
    }
}
