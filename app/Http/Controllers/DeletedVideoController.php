<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeletedVideosRequest;
use App\Http\Requests\UpdateDeletedVideosRequest;
use App\Http\Resources\DeletedVideosResource;
use App\Models\DeletedVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeletedVideoController extends Controller
{
    public static function routeName()
    {
        return Str::snake("DeletedVideo");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function index(Request $request)
    {
        return DeletedVideosResource::collection(DeletedVideo::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreDeletedVideosRequest $request)
    {
        $deletedVideos = DeletedVideo::create($request->validated());
        return new DeletedVideosResource($deletedVideos);
    }
    public function show(DeletedVideo $deletedVideo)
    {
        return new DeletedVideosResource($deletedVideo);
    }
    public function update(UpdateDeletedVideosRequest $request, DeletedVideo $deletedVideo)
    {
        $deletedVideo->update($request->validated());
        return new DeletedVideosResource($deletedVideo);
    }
    public function destroy(DeletedVideo $deletedVideo)
    {
        $deletedVideo->delete();
        return new DeletedVideosResource($deletedVideo);
    }
}
