<?php

Route::group(['middleware' => 'web'], function() {

    Route::post('/logout', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@postLogout'
    ]);

});

Route::group(['middleware' => ['guest', 'web']], function () {

    Route::get('/login', [
        'as' => 'get_login',
        'uses' => 'Auth\AuthController@getLogin'
    ]);

    Route::get('/register', [
        'as' => 'get_register',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::post('/login', [
        'as' => 'post_login',
        'uses' => 'Auth\AuthController@postLogin'
    ]);

    Route::post('/register', [
        'as' => 'post_register',
        'uses' => 'Auth\AuthController@postRegister'
    ]);

    Route::get('/auth/facebook', [
        'as' => 'auth.facebook',
        'uses' => 'Auth\Social\FacebookAuthController@redirectToProvider',
    ]);

    Route::get('auth/facebook/callback', [
        'as' => 'auth.facebook.redirect',
        'uses' => 'Auth\Social\FacebookAuthController@handleProviderCallback',
    ]);

    Route::get('/auth/google', [
        'as' => 'auth.google',
        'uses' => 'Auth\Social\GoogleAuthController@redirectToProvider',
    ]);

    Route::get('auth/google/callback', [
        'as' => 'auth.google.redirect',
        'uses' => 'Auth\Social\GoogleAuthController@handleProviderCallback',
    ]);

});

