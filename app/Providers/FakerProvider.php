<?php

namespace nataalam\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory;

class FakerProvider extends ServiceProvider
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
        $this->app->singleton("faker", function() {
            return Factory::create();
        });
    }
}
