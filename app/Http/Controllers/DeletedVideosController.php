<?php

namespace App\Http\Controllers;

use App\Events\VideoLogEvent;
use App\Http\Requests\StoreDeletedVideosRequest;
use App\Http\Requests\UpdateDeletedVideosRequest;
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
    }
    public function index(Request $request)
    {
        return DeletedVideosResource::collection(DeletedVideos::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreDeletedVideosRequest $request)
    {
        $deletedVideos = DeletedVideos::create($request->validated());
        return new DeletedVideosResource($deletedVideos);
    }
    public function show(DeletedVideos $DeletedVideos)
    {
        return new DeletedVideosResource($DeletedVideos);
    }
    public function update(UpdateDeletedVideosRequest $request, DeletedVideos $deletedVideos)
    {
        $deletedVideos->update($request->validated());
        return new DeletedVideosResource($deletedVideos);
    }
    public function destroy(DeletedVideos $deletedVideos)
    {
        $deletedVideos->delete();
        return new DeletedVideosResource($deletedVideos);
    }
}
