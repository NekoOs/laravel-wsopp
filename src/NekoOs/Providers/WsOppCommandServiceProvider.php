<?php

namespace NekoOs\Providers;

use Illuminate\Support\ServiceProvider;
use eCreeth\LaravelResourceView\LaravelResourceView;

class WsOppCommandServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            WsOppCommandServiceProvider::class
        ]);
    }
}
