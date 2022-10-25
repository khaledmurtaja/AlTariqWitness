<?php

namespace App\Http\Controllers;

use App\Events\VideoLogEvent;
use App\Http\Requests\StoreDeletedVideosRequest;
use App\Http\Resources\DeletedVideosResource;
use App\Models\DeletedVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeletedVideosController extends Controller
{
    public static function routeName()
    {
        return str::snake('DeletedVideos');
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
        //   $this->authorizeResource(ExtractedVideos::class, Str::snake("ExtractedVideos"));
    }

    public function index(Request $request)
    {
        return DeletedVideosResource::collection(DeletedVideos::search($request)->sort($request)->paginate($this->pagination));
    }

    public function store(StoreDeletedVideosRequest $request)
    {
        $deletedVideos = DeletedVideos::create($request->validated());
        VideoLogEvent::dispatch($deletedVideos, 0);
        return new DeletedVideosResource($deletedVideos);
    }
    public function show(DeletedVideos $deletedVideos)
    {
        return new DeletedVideosResource($deletedVideos);
    }
    public function update(Request $request, DeletedVideos $deletedVideos)
    {
        $deletedVideos->update();
        VideoLogEvent::dispatch($deletedVideos, 2);
        return new DeletedVideosResource($deletedVideos);
    }
    public function destroy(DeletedVideos $deletedVideos)
    {
        $deletedVideos->delete();
        VideoLogEvent::dispatch($deletedVideos, 3);
        return new DeletedVideosResource($deletedVideos);
    }
}
