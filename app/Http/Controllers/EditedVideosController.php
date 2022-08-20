<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditedVideosRequest;
use App\Http\Requests\UpdateEditedVideosRequest;
use App\Http\Resources\EditedVideosResource;
use App\Models\EditedVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EditedVideosController extends Controller
{
    public static function routeName()
    {
        return Str::snake("EditedVideos");
    }
    public function index(Request $request)
    {
        return EditedVideosResource::collection(EditedVideos::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreEditedVideosRequest $request)
    {
        $EditedVideos = EditedVideos::create($request->validated());
        return new EditedVideosResource($EditedVideos);
    }
    public function show(Request $request, EditedVideos $EditedVideos)
    {
        return new EditedVideosResource($EditedVideos);
    }
    public function update(UpdateEditedVideosRequest $request, EditedVideos $EditedVideos)
    {
        $EditedVideos->update($request->validated());
        return new EditedVideosResource($EditedVideos);
    }
    public function destroy(Request $request, EditedVideos $EditedVideos)
    {
        $EditedVideos->delete();
        return new EditedVideosResource($EditedVideos);
    }
}
