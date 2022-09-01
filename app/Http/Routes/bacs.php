<?php

Route::group(['middleware' => 'web'], function() {
    Route::get('/subjects/{subject}/bacs/{type?}', [
        'as' => 'bacs.index',
        'uses' => 'BacController@indexInFrontend'
    ]);

    Route::group(['prefix' => 'api'], function() {
        Route::get('/subjects/{subject}/bacs/{type?}', [
            'as' => 'api.bacs.index',
            'uses' => 'BacController@apiIndex'
        ]);
    });
});

Route::group(['middleware' => ['admin']], function () {

    Route::post('/subjects/{subject}/bacs', [
        'as' => 'bacs.store',
        'uses' => 'BacController@store',
    ]);

    Route::delete('/bacs/{bac}', [
        'as' => 'bacs.destroy',
        'uses' => 'BacController@destroy',
    ]);

    Route::put('bacs/{bac}', [
        'as' => 'bacs.update',
        'uses' => 'BacController@update',
    ]);

    Route::group(['prefix' => '/admin'], function() {
        Route::get('/subjects/{subject}/bacs', [
            'as' => 'admin.bacs.index',
            'uses' => 'BacController@indexInAdmin',
        ]);

        Route::get('/subjects/{subject}/bacs/create', [
            'as' => 'admin.bacs.create',
            'uses' => 'BacController@createInAdmin'
        ]);

        Route::get('bacs/{bac}/edit', [
            'as' => 'admin.bacs.edit',
            'uses' => 'BacController@edit',
        ]);
    });
});