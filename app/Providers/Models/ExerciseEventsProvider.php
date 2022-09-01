<?php

namespace nataalam\Providers\Models;

use File;
use Illuminate\Support\ServiceProvider;
use nataalam\Models\Exercise;

class ExerciseEventsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Exercise::deleting(function(Exercise $exercise) {
            File::deleteDirectory($exercise->imagesStorage());
        });

        Exercise::saved(function(Exercise $exercise) {
            if (!File::exists($exercise->imagesStorage()))
                File::makeDirectory($exercise->imagesStorage());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
