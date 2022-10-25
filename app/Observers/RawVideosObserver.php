<?php

namespace App\Observers;

use App\Exceptions\FileNotFoundException;
use App\Models\RawVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RawVideosObserver
{
    public function creating(RawVideos $rawVideos)
    {
        $rawVideos->user_id = auth()->user()->id;
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $rawVideos->url =  store_file($thumbnail);
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        if ($file)
            $rawVideos->url =  store_file($file);
    }
    public function updated(RawVideos $rawVideos)
    {
        //
    }
    public function deleted(RawVideos $rawVideos)
    {
        Storage::disk('public')->delete($rawVideos->url);
    }
}
