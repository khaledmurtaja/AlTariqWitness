<?php

namespace App\Observers;

use App\Events\VideoLogEvent;
use App\Exceptions\FileNotFoundException;
use App\Models\EditedVideos;
use Illuminate\Support\Facades\Storage;

class EditedVideosObserver
{
    public function creating(EditedVideos $editedVideos)
    {
        $editedVideos = handle_video_upload($editedVideos);
    }
    public function created(EditedVideos $editedVideos)
    {
        VideoLogEvent::dispatch($editedVideos, 0);
    }
    public function updated(EditedVideos $editedVideos)
    {
        VideoLogEvent::dispatch($editedVideos, 2);
    }
    public function deleted(EditedVideos $editedVideos)
    {
        Storage::disk('public')->delete($editedVideos->url);
        VideoLogEvent::dispatch($editedVideos, 3);
    }
}
