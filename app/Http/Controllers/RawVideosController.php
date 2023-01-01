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
    }
    public function index(Request $request)
    {
        return RawVideosResource::collection(RawVideos::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreRawVideosRequest $request)
    {
        $EditedVideos = RawVideos::create($request->validated());
        return new RawVideosResource($EditedVideos);
    }
    public function show(RawVideos $rawVideo)
    {
        return new RawVideosResource($rawVideo);
    }
    public function update(RawVideos $rawVideo, UpdateRawVideosRequest $request)
    {
        $rawVideo->update($request->validated());
        return new RawVideosResource($rawVideo);
    }
    public function destroy(RawVideos $rawVideo)
    {
        $rawVideo->delete();
        return new RawVideosResource($rawVideo);
    }
}
