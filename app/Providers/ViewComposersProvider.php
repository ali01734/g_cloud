<?php

namespace nataalam\Providers;

use nataalam\Http\ViewComposers\SideBarLinksComposer;
use nataalam\Http\ViewComposers\TopBarComposer;
use nataalam\Http\ViewComposers\SocialLinksComposer;

class ViewComposersProvider extends BootOnlyServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['admin.partials.sidebar', 'admin.index'],
            SideBarLinksComposer::class
        );
        view()->composer('client.base', TopBarComposer::class);
        View()->composer('client._footer', SocialLinksComposer::class);
    }
}
