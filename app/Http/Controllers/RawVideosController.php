<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRawVideosRequest;
use App\Http\Requests\UpdateRawVideosRequest;
use App\Http\Resources\RawVideosResource;
use App\Models\RawVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class RawVideosController extends Controller
{
    public static function routeName()
    {
        return Str::snake("RawVideos");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // $this->authorizeResource(RawVideos::class, Str::snake("RawVideos"));
    }
    public function index(Request $request)
    {
        return RawVideosResource::collection(RawVideos::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreRawVideosRequest $request)
    {
        // $currentUserInfo = Location::get('165.159.24.227');
        //dd($currentUserInfo);
        $EditedVideos = RawVideos::create($request->validated());
        return new RawVideosResource($EditedVideos);
    }
    public function show($id)
    {
        return new RawVideosResource(RawVideos::find($id));
    }
    public function update($id, UpdateRawVideosRequest $request)
    {
        $rawVideos = RawVideos::find($id);
        $rawVideos->update($request->validated());
        return new RawVideosResource($rawVideos);
    }
    public function destroy($id)
    {
        $rawVideos = RawVideos::find($id);
        $rawVideos->delete();
        return new RawVideosResource($rawVideos);
    }
}
