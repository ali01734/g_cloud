<?php

/**
 * Courses
 */



Route::get('/courses/{id}', [
    'as' => 'courses.show',
    'uses' => 'CourseController@showInFrontend',
]);

Route::get('subjects/{subject}/levels/{level}/branches/{branch}/courses', [
    'as' => 'levels.branches.courses.index',
    'uses' => 'CourseController@jsonIndex'
]);

/**
 * In admin UI
 */
Route::group(['middleware' => 'admin'], function () {
        Route::post('/subjects/{subject}/courses', [
            'as' => 'courses.store',
            'uses' => 'CourseController@store'
        ]);

        Route::put('courses/{course}', [
            'as' => 'courses.update',
            'uses' => 'CourseController@update',
        ]);

        Route::delete('courses/{course}', [
            'as' => 'courses.destroy',
            'uses' => 'CourseController@destroy',
        ]);

        Route::group(['prefix' => '/admin'], function() {
            Route::get('courses/{id}', [
                'as' => 'admin.courses.show',
                'uses' => 'CourseController@showInAdmin',
            ]);

            Route::get('subjects/{id}/courses/create', [
                'as' => 'admin.courses.create',
                'uses' => 'CourseController@createInAdmin'
            ]);

            Route::get('courses/{id}/edit', [
                'as' => 'admin.courses.edit',
                'uses' => 'CourseController@editInAdmin',
            ]);
        });
    }
);

