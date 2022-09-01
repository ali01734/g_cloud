<?php

Route::group(['middleware' => 'web'], function() {
    Route::get('/users/{user}', [
        'as' => 'users.show',
        'uses' => 'UserController@showInFrontend'
    ]);

    Route::put('users/{user}/password', [
        'as' => 'users.passwords.update',
        'uses' => 'UserController@updatePassword'
    ]);

    Route::get('users/{user}/password', [
        'as' => 'users.confirm',
        'uses' => 'UserController@confirmMailAddress',
    ]);

    Route::group(['middleware' => 'auth'], function() {
        Route::put('users/{user}', [
            'uses' => 'UserController@update',
            'as' => 'users.update',
        ]);

        Route::patch('/users/{user}/photo', [
            'as' => 'users.photos.update',
            'uses' => 'UserController@updatePhoto',
        ]);

        Route::get('users/{user}/settings', [
            'as' => 'users.settings',
            'uses' => 'UserController@settings',
        ]);

        Route::post('users/confirm/resend', [
            'as' => 'users.confirm.resend',
            'uses' => 'UserController@resendConfirmationMail',
        ]);
    });
});