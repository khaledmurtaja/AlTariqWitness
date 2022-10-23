<?php

namespace App\Observers;

use App\Models\RawVideos;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RawVideosObserver
{
    public function creating(RawVideos $rawVideos)
    {
        $thumbnail = request('thumbnail');
        if ($thumbnail) {
            $mimetype = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $rawVideos->thumbnail = $path;
        }
        $file = request('file');
        if ($file) {
            $mimetype = $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $rawVideos->url = $path;
        }
    }
    public function deleted(RawVideos $rawVideos)
    {
        Storage::disk('public')->delete($rawVideos->url);
    }
}
