<?php

namespace App\Observers;

use App\Events\VideoLogEvent;
use App\Exceptions\FileNotFoundException;
use App\Models\ExtractedVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ExtractedVideosObserver
{
    public function creating(ExtractedVideos $extractedVideos)
    {
        $extractedVideos = handle_video_upload($extractedVideos);
    }
    public function created(ExtractedVideos $extractedVideos)
    {
        VideoLogEvent::dispatch($extractedVideos, 0);
    }
    public function updated(ExtractedVideos $extractedVideos)
    {
        VideoLogEvent::dispatch($extractedVideos, 2);
        //
    }
    public function deleted(ExtractedVideos $extractedVideos)
    {
        Storage::disk('public')->delete($extractedVideos->url);
        VideoLogEvent::dispatch($extractedVideos, 3);
    }
}
