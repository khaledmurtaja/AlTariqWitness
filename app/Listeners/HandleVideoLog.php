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
        $ip_address = request('ip_address');
        $currentUserInfo = Location::get($ip_address);
        Logs::create([
            'associatable_type' => explode("video", get_class_name(get_class($event->video)))[0],
            'associatable_id' => $event->video->id,
            'ip_address' => $event->video->ip_address,
            'user_id' => auth()->user()->id ?? $event->video->user_id,
            'action_type' => $event->action,
            'country' => $currentUserInfo->countryName ?? 'undefined',
            'city' => $currentUserInfo->cityName ?? 'undefined',
            'region' => $currentUserInfo->regionName ?? 'undefined',
        ]);
    }
}
