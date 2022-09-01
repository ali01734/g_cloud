<?php

/**
 * Lessons route file
 */

Route::group(['middleware' => 'web'], function() {
    Route::get('lessons/{lesson}', [
        'uses' => 'LessonController@showInFrontend' ,
        'as' => 'lessons.show'
    ]);

    Route::get('courses/{course}/lessons', [
        'as' => 'lessons.index',
        'uses' => 'LessonController@indexInFrontend',
    ]);
});


Route::group(['middleware' => 'admin'], function () {
    Route::post('courses/{course}/lessons', [
        'as' => 'lessons.store',
        'uses' => 'LessonController@store',
    ]);

    Route::put('lessons/{lesson}', [
        'as' => 'lessons.update',
        'uses' => 'LessonController@update',
    ]);

    Route::delete('/lessons/{lesson}', [
        'as' => 'lessons.destroy',
        'uses' => 'LessonController@destroy'
    ]);

    Route::group(['prefix' => '/admin'], function() {
        /**
         * Lessons
         */
        Route::get('courses/{course}/lessons/create', [
            'as' => 'admin.lessons.create',
            'uses' => 'LessonController@createInAdmin'
        ]);

        Route::get('lessons/{lesson}/edit', [
            'as' => 'admin.lessons.edit',
            'uses' => 'LessonController@editInAdmin'
        ]);
    });

});