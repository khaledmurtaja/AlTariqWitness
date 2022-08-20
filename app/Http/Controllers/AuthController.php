<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if ($token) {
            $user = User::where('email', '=', $credentials['email'])->first();
            if ($user->status == 1) {
                $token = $user->createToken('Laravel Personal Access Client');
                return $this->respondWithToken($token);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function user()
    {
        $user = auth()->user();
        return response()->json(compact('user'));
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {

        return response()->json([
            'token' => $token->accessToken,
            'token_type' =>  'bearer',
            'user' => auth()->user()
        ]);
    }
}
