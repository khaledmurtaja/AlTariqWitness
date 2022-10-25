<?php

namespace App\Observers;

use App\Exceptions\FileNotFoundException;
use App\Models\EditedVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditedVideosObserver
{
    public function creating(EditedVideos $editedVideos)
    {
        $editedVideos->user_id = auth()->user()->id;
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $editedVideos->url =  store_file($thumbnail);
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        if ($file)
            $editedVideos->url =  store_file($file);
    }
    public function updated(EditedVideos $editedVideos)
    {
        //
    }
    public function deleted(EditedVideos $editedVideos)
    {
        Storage::disk('public')->delete($editedVideos->url);
    }
}
