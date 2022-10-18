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
        return Str::snake("EditedVideosKeywords");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function index(Request $request)
    {
        return EditedVideosKeywordsResource::collection(EditedVideosKeywords::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreEditedVideosKeywordsRequest $request)
    {
        $EditedVideosKeywords = EditedVideosKeywords::insert($request->validated()['keywords']);
        return response(['message' => 'success'], 201);
    }
    public function show($id)
    {
        return new EditedVideosKeywordsResource(EditedVideosKeywords::find($id));
    }
    public function update($id, UpdateEditedVideosKeywordsRequest $request)
    {
        $EditedVideosKeywords = EditedVideosKeywords::find($id);
        $EditedVideosKeywords->update($request->validated());
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
    public function destroy($id)
    {
        $EditedVideosKeywords = EditedVideosKeywords::find($id);
        $EditedVideosKeywords->delete();
        return new EditedVideosKeywordsResource($EditedVideosKeywords);
    }
}
