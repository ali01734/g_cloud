<?php


/**
 * Subjects
 */

Route::group(['middleware' => 'web'], function() {

    Route::get('subjects', [
        'as' => 'subjects.index',
        'uses' => 'SubjectController@frontendIndex'
    ]);

    Route::get('subjects/{subject}', [
        'as' => 'subjects.show',
        'uses' => 'SubjectController@showInFrontend'
    ]);
});


Route::group(['middleware' => 'admin'], function () {

    Route::post('subjects/', [
        'as' => 'subjects.store',
        'uses' => 'SubjectController@store'
    ]);

    Route::delete('subjects/{subject}', [
        'as' => 'subjects.destroy',
        'uses' => 'SubjectController@destroy'
    ]);

    Route::put('subjects/{id}', [
        'as' => 'subjects.update',
        'uses' => 'SubjectController@update'
    ]);

    Route::group(['prefix' => '/admin'], function() {
        Route::get('subjects', [
            'as' => 'admin.subjects.index',
            'uses' => 'SubjectController@adminIndex'
        ]);

        Route::get('subjects/create', [
            'as' => 'admin.subjects.create',
            'uses' => 'SubjectController@createInAdmin'
        ]);

        Route::get('subjects/{subject}', [
            'as' => 'admin.subjects.show',
            'uses' => 'SubjectController@showInAdmin'
        ]);

        Route::get('subjects/{id}/edit', [
            'as' => 'admin.subjects.edit',
            'uses' => 'SubjectController@editInAdmin'
        ]);
    });

});

