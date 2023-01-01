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
    public function __construct(Request $request)
    {
        parent::__construct($request);
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
    public function show(EditedVideos $editedVideo)
    {
        return new EditedVideosResource($editedVideo);
    }
    public function update(UpdateEditedVideosRequest $request, EditedVideos $editedVideo)
    {
        $editedVideo->update($request->validated());
        return new EditedVideosResource($editedVideo);
    }
    public function destroy(EditedVideos $editedVideo)
    {
        $editedVideo->delete();
        return new EditedVideosResource($editedVideo);
    }
}
