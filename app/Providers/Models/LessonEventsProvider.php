<?php

namespace nataalam\Providers\Models;

use File;
use Illuminate\Support\ServiceProvider;
use nataalam\Models\Lesson;

class LessonEventsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Lesson::deleting(function(Lesson $lesson) {
            File::deleteDirectory($lesson->imagesStorage());
        });

        Lesson::saved(function(Lesson $lesson) {
            if (!File::exists($lesson->imagesStorage()))
                File::makeDirectory($lesson->imagesStorage());
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
