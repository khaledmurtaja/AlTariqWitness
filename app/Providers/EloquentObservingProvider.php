<?php

namespace App\Providers;

use App\Exceptions\ActionNotAllowedException;
use App\Models\Tenant\UserActivity;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EloquentObservingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      
        Event::listen(['eloquent.created: *', 'eloquent.updated: *', 'eloquent.deleted: *'], function ($event, $data) {
            
            
        });
    }
}
