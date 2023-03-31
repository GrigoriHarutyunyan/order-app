<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Services\Order\OrderServiceInterface::class, \App\Services\Order\OrderService::class);
        $this->app->bind(\App\Services\Filter\FilterServiceInterface::class, \App\Services\Filter\FilterService::class);
        $this->app->bind(\App\Services\Filter\OrderFilterServiceInterface::class, \App\Services\Filter\OrderFilterService::class);
        //:end-bindings:
    }
}
