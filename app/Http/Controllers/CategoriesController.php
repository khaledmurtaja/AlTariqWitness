<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\EditedVideosKeywordsResource;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public static function routeName()
    {
        return Str::snake("Categories");
    }
    public function index(Request $request)
    {
        return CategoriesResource::collection(Categories::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreCategoriesRequest $request)
    {
        $EditedVideos = Categories::create($request->validated());
        return new CategoriesResource($EditedVideos);
    }
    public function show(Request $request, Categories $EditedVideos)
    {
        return new CategoriesResource($EditedVideos);
    }
    public function update(UpdateCategoriesRequest $request, Categories $EditedVideos)
    {
        $EditedVideos->update($request->validated());
        return new CategoriesResource($EditedVideos);
    }
    public function destroy(Request $request, Categories $EditedVideos)
    {
        $EditedVideos->delete();
        return new CategoriesResource($EditedVideos);
    }
}
