<?php

namespace nataalam\Providers;

use Illuminate\Support\ServiceProvider;
use nataalam\Http\ViewComposers\SideBarLinksComposer;
use nataalam\Http\ViewComposers\TopBarComposer;

class BootOnlyServiceProvider extends ServiceProvider
{
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
