<?php

Route::group(['middleware' => ['web', 'check_mail_confirmation']], function() {
    Route::post('/exercises/{id}/comments', [
        'as' => 'exercises.comments.store',
        'uses' => 'CommentController@storeInExercise',
    ]);

    Route::post('/lessons/{id}/comments', [
        'as' => 'lessons.comments.store',
        'uses' => 'CommentController@storeInLesson',
    ]);

    Route::post('/subjects/{id}/comments', [
        'as' => 'subjects.comments.store',
        'uses' => 'CommentController@storeInSubjectAsBacComment'
    ]);

    Route::post('/comments/{id}/replies', [
        'as' => 'replies.store',
        'uses' => 'CommentController@storeReply'
    ]);

    Route::post('/comments/{id}/reports', [
        'as' => 'comments.report',
        'uses' => 'CommentController@report'
    ]);

    Route::delete('comments/{comment}', [
        'as' => 'comments.destroy',
        'uses' => 'CommentController@destroy',
    ]);
});


Route::group(['middleware' => ['admin']], function () {

    Route::delete('comments/{id}/reports', [
        'as' => 'comments.reports.clear',
        'uses' => 'CommentController@clearReports'
    ]);

    Route::patch('/comments/{id}/block_repoting', [
        'as' => 'comments.block_reporting',
        'uses' => 'CommentController@blockReporting',
    ]);

    Route::group(['prefix' => '/admin'], function() {
        Route::get('/comments', [
            'as' => 'admin.comments.index',
            'uses' => 'CommentController@indexInAdmin'
        ]);
    });
});

