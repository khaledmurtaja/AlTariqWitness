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
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function index(Request $request)
    {
        return RawVideoTagsResource::collection(RawVideoTags::search($request)->sort($request)->paginate($this->pagination));
    }
    public function store(StoreRawVideoTagsRequest $request)
    {
        $rawVideoTags = RawVideoTags::insert($request->validated()['tags']);
        return response(['message' => 'success'], 201);
    }
    public function show($id)
    {
        return new RawVideoTagsResource(RawVideoTags::find($id));
    }
    public function update($id, UpdateRawVideoTagsRequest $request)
    {
        $rawVideoTags = RawVideoTags::find($id);
        $rawVideoTags->update($request->validated());
        return new RawVideoTagsResource($rawVideoTags);
    }
    public function destroy($id)
    {
        $rawVideoTags = RawVideoTags::find($id);
        $rawVideoTags->delete();
        return new RawVideoTagsResource($rawVideoTags);
    }
}
