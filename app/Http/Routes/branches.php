<?php
/**
 * Branches route file
 */

Route::group(['middleware' => 'web'], function() {
    Route::get('subjects/{sid}/levels/{lid}/branches/{bid}', [
        'as' => 'branches.show',
        'uses' => 'BranchController@showInFrontend'
    ]);
});

Route::group(['middleware' => 'admin', 'prefix' => 'branches'], function() {
    Route::post('', [
        'as' => 'branches.store',
        'uses' => 'BranchController@store'
    ]);

    Route::delete('{branch}', [
        'as' => 'branches.destroy',
        'uses' => 'BranchController@destroy',
    ]);

    Route::put('{branch}', [
        'as' => 'branches.update',
        'uses' => 'BranchController@update',
    ])->where('branch', '[0-9]+');
});

Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin/branches'
    ], function() {
        Route::get('', [
            'as' => 'admin.branches.index',
            'uses' => 'BranchController@indexInAdmin',
        ]);

        Route::get('bac_type', [
            'as' => 'admin.branches.bac_type',
            'uses' => 'BranchController@showBranchesTypeForm',
        ]);
    }
);