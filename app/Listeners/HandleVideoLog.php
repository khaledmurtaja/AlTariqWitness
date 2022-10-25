<?php

namespace App\Listeners;

use App\Models\Logs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stevebauman\Location\Facades\Location;

class HandleVideoLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $currentUserInfo = Location::get('165.159.24.227');
        Logs::create([
            'associatable_type' => explode("video", get_class_name(get_class($event->video)))[0],
            'associatable_id' => $event->video->id,
            'ip_address' => $event->video->ip_address,
            'user_id' => auth()->user()->id ?? $event->video->user_id,
            'action_type' => $event->action,
            'country' => $currentUserInfo->countryName,
            'city' => $currentUserInfo->cityName,
            'region' => $currentUserInfo->regionName,
        ]);
    }
}
