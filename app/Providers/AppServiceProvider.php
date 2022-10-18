<?php

namespace App\Providers;

use App\Models\EditedVideos;
use App\Models\RawVideos;
use App\Models\User;
use App\Observers\EditedVideosObserver;
use App\Observers\RawVideosObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        EditedVideos::observe(EditedVideosObserver::class);
        RawVideos::observe(RawVideosObserver::class);
    }
}
