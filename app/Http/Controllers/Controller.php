<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $except, $pagination, $user;
    public function __construct(Request $request)
    {
        $this->middleware('auth:api', ['except' => $this->except]);
        $this->pagination = request('per_page') ?? 15;
        //$this->user = User::find(auth()->user()->id);
    }
}
