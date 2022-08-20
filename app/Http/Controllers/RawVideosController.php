<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRawVideosRequest;
use App\Http\Requests\UpdateRawVideosRequest;
use App\Http\Resources\RawVideosResource;
use App\Models\RawVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RawVideosController extends Controller
{
    public static function routeName()
    {
        return Str::snake("RawVideos");
    }
    public function index(Request $request)
    {
        return RawVideosResource::collection(RawVideos::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreRawVideosRequest $request)
    {
        // $res = RawVideos::file_get_contents_curl("https://logos-download.com/wp-content/uploads/2016/09/Laravel_logo.png");
        // $file = file_put_contents("test2.png", $res);
        // Storage::disk('public')->put("files/tesg.png", $file);
        $EditedVideos = RawVideos::create($request->validated());
        return new RawVideosResource($EditedVideos);
    }
    public function show(Request $request, RawVideos $EditedVideos)
    {
        return new RawVideosResource($EditedVideos);
    }
    public function update(UpdateRawVideosRequest $request, RawVideos $EditedVideos)
    {
        $EditedVideos->update($request->validated());
        return new RawVideosResource($EditedVideos);
    }
    public function destroy(Request $request, RawVideos $EditedVideos)
    {
        $EditedVideos->delete();
        return new RawVideosResource($EditedVideos);
    }
}
