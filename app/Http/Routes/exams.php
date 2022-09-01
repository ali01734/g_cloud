<?php

Route::group(['middleware' => 'web'], function() {
    Route::get('/courses/{course}/exams', [
        'as' => 'exams.index',
        'uses' => 'ExamController@indexInFrontend',
    ]);

    Route::get('/courses/{course}/exams', [
        'as' => 'exams.index',
        'uses' => 'ExamController@indexInFrontend',
    ]);

    Route::group(['prefix' => 'api'], function() {
        Route::get('courses/{course}/exams', [
            'as' => 'api.exams.index',
            'uses' => 'ExamController@apiIndex'
        ]);
    });

});


Route::group(['middleware' => 'admin'], function () {

    Route::post('/subjects/{id}/exams', [
        'as' => 'exams.store',
        'uses' => 'ExamController@store'
    ]);

    Route::delete('/exams/{id}', [
        'as' => 'exams.delete',
        'uses' => 'ExamController@destroy',
    ]);

    Route::put('/exams/{exam}', [
        'as' => 'exams.update',
        'uses' => 'ExamController@update'
    ]);

    Route::group(['prefix' => '/admin'], function() {
        Route::get('/subjects/{id}/exams', [
            'as' => 'admin.exams.index',
            'uses' => 'ExamController@adminIndex'
        ]);

        Route::get('/exams/{id}/edit', [
            'as' => 'admin.exams.edit',
            'uses' => 'ExamController@editInAdmin',
        ]);

        Route::get('/subjects/{id}/exams/create', [
            'as' => 'admin.exams.create',
            'uses' => 'ExamController@createInAdmin'
        ]);
    });

});