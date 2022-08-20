<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRawVideoTagsRequest;
use App\Http\Requests\UpdateRawVideoTagsRequest;
use App\Http\Resources\RawVideoTagsResource;
use App\Models\RawVideoTags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RawVideoTagsController extends Controller
{
    public static function routeName()
    {
        return Str::snake("RawVideoTags");
    }
    public function index(Request $request)
    {
        return RawVideoTagsResource::collection(RawVideoTags::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreRawVideoTagsRequest $request)
    {
        $rawVideoTags = RawVideoTags::create($request->validated());
        return new RawVideoTagsResource($rawVideoTags);
    }
    public function show(Request $request, RawVideoTags $rawVideoTags)
    {
        return new RawVideoTagsResource($rawVideoTags);
    }
    public function update(UpdateRawVideoTagsRequest $request, RawVideoTags $rawVideoTags)
    {
        $rawVideoTags->update($request->validated());
        return new RawVideoTagsResource($rawVideoTags);
    }
    public function destroy(Request $request, RawVideoTags $rawVideoTags)
    {
        $rawVideoTags->delete();
        return new RawVideoTagsResource($rawVideoTags);
    }
}