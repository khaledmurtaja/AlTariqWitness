<?php

namespace App\Observers;

use App\Events\VideoLogEvent;
use App\Exceptions\FileNotFoundException;
use App\Models\RawVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RawVideosObserver
{
    public function creating(RawVideos $rawVideos)
    {
        $rawVideos = handle_video_upload($rawVideos);
    }
    public function created(RawVideos $rawVideos)
    {
        VideoLogEvent::dispatch($rawVideos, 0);
    }
    public function updated(RawVideos $rawVideos)
    {
        VideoLogEvent::dispatch($rawVideos, 2);
        //
    }
    public function deleted(RawVideos $rawVideos)
    {
        Storage::disk('public')->delete($rawVideos->url);
        VideoLogEvent::dispatch($rawVideos, 3);
    }
}
