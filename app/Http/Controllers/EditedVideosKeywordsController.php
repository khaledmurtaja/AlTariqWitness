<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditedVideosKeywordsRequest;
use App\Http\Requests\UpdateEditedVideosKeywordsRequest;
use App\Http\Resources\EditedVideosKeywordsResource;
use App\Models\EditedVideosKeywords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EditedVideosKeywordsController extends Controller
{
    public static function routeName()
    {
        return Str::snake("EditedVideos");
    }
    public function index(Request $request)
    {
        return EditedVideosKeywordsResource::collection(EditedVideosKeywords::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreEditedVideosKeywordsRequest $request)
    {
        $EditedVideosKeywords = EditedVideosKeywords::create($request->validated());
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
    public function show(Request $request, EditedVideosKeywords $EditedVideosKeywords)
    {
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
    public function update(UpdateEditedVideosKeywordsRequest $request, EditedVideosKeywords $EditedVideosKeywords)
    {
        $EditedVideosKeywords->update($request->validated());
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
    public function destroy(Request $request, EditedVideosKeywords $EditedVideosKeywords)
    {
        $EditedVideosKeywords->delete();
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
}
