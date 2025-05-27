<?php

namespace Tots\Infobip\Providers;

use Illuminate\Support\ServiceProvider;
use Tots\Infobip\Services\TotsInfobipService;

class TotsInfobipServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register role singleton
        $this->app->singleton(TotsInfobipService::class, function ($app) {
            return new TotsInfobipService(config('infobip'));
        });
    }

    /**
     *
     * @return void
     */
    public function boot()
    {
        
    }
}