<?php

namespace App\Observers;

use App\Exceptions\FileNotFoundException;
use App\Models\ExtractedVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ExtractedVideosObserver
{
    public function creating(ExtractedVideos $extractedVideos)
    {
        $extractedVideos->user_id = auth()->user()->id;
        $thumbnail = request('thumbnail');
        if ($thumbnail)
            $extractedVideos->url =  store_file($thumbnail);
        $file = request('file');
        if (!$file)
            throw new FileNotFoundException();
        if ($file)
            $extractedVideos->url =  store_file($file);
    }
    public function updated(ExtractedVideos $extractedVideos)
    {
        //
    }
    public function deleted(ExtractedVideos $extractedVideos)
    {
        Storage::disk('public')->delete($extractedVideos->url);
    }
}
