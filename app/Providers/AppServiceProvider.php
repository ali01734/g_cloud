<?php

namespace nataalam\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'old_password',
            function($attribute, $value, $parameters, $validator) {
                return \Hash::check($value, \Auth::user()->password);
            }
        );

        Validator::extend(
            'email_confirmation',
            function($attribute, $value, $parameters, $validator) {
                $user = \Route::current()->parameter('user');
                return $user->verification_code == $value;
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
