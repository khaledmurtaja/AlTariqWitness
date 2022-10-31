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
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        $rawVideos->url =  store_file($file);
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $rawVideos->thumbnail =  store_file($thumbnail);
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
