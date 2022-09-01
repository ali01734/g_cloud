<?php

/**
* Exercises route file
*/

Route::group(['middleware' => 'web'], function() {
    Route::get('/exercises/{exercise}', [
        'as' => 'exercises.show',
        'uses' => 'ExerciseController@showInFrontend'
    ]);

    Route::get('/courses/{course}/exercises', [
        'as' => 'exercises.index',
        'uses' => 'ExerciseController@indexInFrontend'
    ]);
});

Route::group(['middleware' => 'admin'], function () {
    Route::put('/exercises/{exercise}', [
        'as' => 'exercises.update',
        'uses' => 'ExerciseController@update'
    ]);

    Route::delete('/exercises/{exercise}', [
        'as' => 'exercises.destroy',
        'uses' => 'ExerciseController@destroy'
    ]);

    Route::post('/courses/{exercise}/exercises', [
        'as' => 'exercises.store',
        'uses' => 'ExerciseController@store'
    ]);

    Route::group(['prefix' => '/admin'], function() {
        Route::get('/exercises/{exercise}/edit', [
            'as' => 'admin.exercises.edit',
            'uses' => 'ExerciseController@edit'
        ]);

        Route::get('/courses/{course}/exercises/create', [
            'as' => 'admin.exercises.create',
            'uses' => 'ExerciseController@create'
        ]);
    });
});