<?php

namespace App\Observers;

use App\Models\EditedVideos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditedVideosObserver
{
    public function creating(EditedVideos $editedVideos)
    {

        $thumbnail = request('thumbnail');
        if ($thumbnail) {
            $mimetype = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $editedVideos->thumbnail = $path;
        }
        $file = request('file');
        if ($file) {
            $mimetype = $file->getClientOriginalExtension();
            $path = $file->storeAs(
                'files',
                uniqid() . '.' . $mimetype,
                'public'
            );
            $editedVideos->url = $path;
        }
    }
}
