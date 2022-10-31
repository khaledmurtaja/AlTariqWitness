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
        $editedVideos->user_id = auth()->user()->id;
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        $editedVideos->url = store_file($file);
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $editedVideos->thumbnail = store_file($thumbnail);
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
