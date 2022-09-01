<?php

namespace nataalam\Http\ViewComposers;

use Illuminate\Contracts\View\View;


class SocialLinksComposer
{
    public function compose(View $view)
    {
        $view->with('socialLinks', [
            'facebook' => [
                'fa' => 'fa-facebook',
                'link' => '',
                'color' => '#3B5998',
            ],
            'google+' => [
                'fa' => 'fa-google-plus',
                'link' => '',
                'color' => '#DB4437',
            ],
            'twitter' => [
                'fa' => 'fa-twitter',
                'color' => '#48AAE6',
                'link' => '',
            ],
            'youtube' => [
                'fa' => 'fa-youtube',
                'color' => '#E62117',
                'link' => '',
            ]
        ]);
    }
}