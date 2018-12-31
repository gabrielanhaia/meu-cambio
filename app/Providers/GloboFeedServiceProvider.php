<?php

namespace App\Providers;

use App\Services\V1\GloboFeed\Contract\FeedIntegration;
use App\Services\V1\GloboFeed\Integration;
use Illuminate\Support\ServiceProvider;

class GloboFeedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FeedIntegration::class, function ($app) {
            return new Integration();
        });
    }
}
