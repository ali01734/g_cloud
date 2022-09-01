<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Phine\Path\Path;
use Symfony\Component\Finder\SplFileInfo;

require __DIR__ . '/Routes/levels.php';
require __DIR__ . '/Routes/branches.php';
require __DIR__ . '/Routes/courses.php';
require __DIR__ . '/Routes/subjects.php';
require __DIR__ . '/Routes/exercises.php';
require __DIR__ . '/Routes/comments.php';
require __DIR__ . '/Routes/users.php';
require __DIR__ . '/Routes/exams.php';
require __DIR__ . '/Routes/bacs.php';
require __DIR__ . '/Routes/login.php';
require __DIR__ . '/Routes/lessons.php';

Route::group(['middleware' => 'web'], function() {
    Route::get('', [
        'as' => 'client_index',
        'uses' => 'ClientController@index'
    ]);

    Route::get('/lessons/v={lesson_id}', [
        'as' => 'client_view_lesson',
        'uses' => 'CoursesBoardController@viewLesson'
    ]);

    Route::post('img_upload', 'CkEditorController@uploadToTmpFolder');

    Route::get('/errors/mail-confirmation', [
        'as' => 'errors.confirm',
        'uses' => 'UserController@showNotConfirmedMailErrorPage',
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});


Route::group([
    'middleware' => ['admin'],
    'prefix' => '/admin'
], function () {

    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'AdminController@index'
    ]);

});
