<?php

namespace App\Observers;

use App\Exceptions\FileNotFoundException;
use App\Models\DeletedVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeletedVideosObserver
{
    public function creating(DeletedVideos $deletedVideos)
    {
        $deletedVideos->user_id = auth()->user()->id;
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $deletedVideos->url =  store_file($thumbnail);
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        if ($file)
            $deletedVideos->url =  store_file($file);
    }
    public function updated(DeletedVideos $deletedVideos)
    {
        //
    }
    public function deleted(DeletedVideos $deletedVideos)
    {
        Storage::disk('public')->delete($deletedVideos->url);
    }
}
