<?php

namespace nataalam\Providers\Debug;

use Colors\Color;
use Illuminate\Support\ServiceProvider;
use nataalam\Debug\ConsoleService;

class ConsoleProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('nataalam.debug.console', function($app) {
            return new ConsoleService(new Color());
        });
    }
}
