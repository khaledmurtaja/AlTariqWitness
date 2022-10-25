<?php

namespace App\Http\Controllers;

use App\Events\VideoLogEvent;
use App\Http\Requests\StoreExtractedVideosRequest;
use App\Http\Requests\UpdateExtractedVideosRequest;
use App\Http\Resources\ExtractedVideosResource;
use App\Models\ExtractedVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtractedVideoContoller extends Controller
{
    public static function routeName()
    {
        return Str::snake("ExtractedVideo");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
        //   $this->authorizeResource(ExtractedVideos::class, Str::snake("ExtractedVideos"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ExtractedVideosResource::collection(ExtractedVideos::search($request)->sort($request)->paginate($this->pagination));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtractedVideosRequest $request)
    {
        $extractedVideos = ExtractedVideos::create(['url' => "1", 'ip_address' => $request->ip(),'country'=>'dd','user_id'=>auth()->user()->id] + $request->validated());
        VideoLogEvent::dispatch($extractedVideos, 0);
        return new ExtractedVideosResource($extractedVideos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ExtractedVideosResource(ExtractedVideos::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExtractedVideosRequest $request, $id)
    {
        $extractedVideos = ExtractedVideos::find($id);
        $extractedVideos->update($request->validated());
        return new ExtractedVideosResource($extractedVideos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExtractedVideos::find($id)->delete();
    }
}
