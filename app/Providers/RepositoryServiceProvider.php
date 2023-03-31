<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Order\OrderRepositoryInterface::class, \App\Repositories\Order\OrderRepository::class);
        $this->app->bind(\App\Repositories\Filter\FilterRepositoryInterface::class, \App\Repositories\Filter\FilterRepository::class);
        $this->app->bind(\App\Repositories\Filter\OrderFilterRepositoryInterface::class, \App\Repositories\Filter\OrderFilterRepository::class);
        //:end-bindings:
    }
}
