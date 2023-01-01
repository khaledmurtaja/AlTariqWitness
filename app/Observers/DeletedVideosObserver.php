<?php

namespace App\Observers;

use App\Events\VideoLogEvent;
use App\Exceptions\FileNotFoundException;
use App\Models\DeletedVideo;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeletedVideosObserver
{
    public function creating(DeletedVideo $deletedVideos)
    {
        $deletedVideos = handle_video_upload($deletedVideos);
    }
    public function created(DeletedVideo $deletedVideos)
    {
        VideoLogEvent::dispatch($deletedVideos, 0);
    }
    public function updated(DeletedVideo $deletedVideos)
    {
        VideoLogEvent::dispatch($deletedVideos, 2);
        //
    }
    public function deleted(DeletedVideo $deletedVideos)
    {
        Storage::disk('public')->delete($deletedVideos->url);
        VideoLogEvent::dispatch($deletedVideos, 3);
    }
}
