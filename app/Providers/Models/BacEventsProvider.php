<?php

namespace nataalam\Providers\Models;

use File;
use Illuminate\Support\ServiceProvider;
use nataalam\Models\BacExamFile;
use nataalam\Http\Controllers\BacController;

class BacEventsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        BacExamFile::deleting(function($bac) {
            File::delete([
                storage_path(BacExamFile::$bacDir . "/$bac->id.pdf"),
                storage_path(BacExamFile::$correctDir . "/$bac->id.pdf")
            ]);
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
