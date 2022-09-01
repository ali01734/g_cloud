<?php

/**
 * Levels routes
 */

Route::post('levels/{id}/branches', [
    'as' => 'levels.branches.store',
    'uses' => 'LevelController@addBranch'
]);

Route::delete('levels/{id}/branches/{branchId}/', [
    'as' => 'levels.branches.unlink',
    'uses' => 'LevelController@removeBranch',
]);

Route::get('levels/{id}/branches', [
    'as' => 'levels.branches.get',
    'uses' => 'LevelController@getBranches'
]);



Route::group(['middleware' => 'admin'], function () {

    Route::post('levels', [
        'uses' => 'LevelController@store',
        'as' => 'levels.store',
    ]);

    Route::delete('levels/{id}', [
        'uses' => 'LevelController@destroy',
        'as' => 'levels.destroy',
    ]);

    Route::put('levels/{id}', [
        'uses' => 'LevelController@update',
        'as' => 'levels.update',
    ]);

    Route::group(['prefix' => '/admin'], function() {

        Route::get('levels/{id}', [
            'as' => 'admin.levels.show',
            'uses' => 'LevelController@showInAdmin'
        ]);

        Route::get('levels', [
            'as' => 'admin.levels.index',
            'uses' => 'LevelController@adminIndex',
        ]);
    });

});