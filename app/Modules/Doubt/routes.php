<?php

Route::group(['module' => 'Doubt', 'middleware' => ['web'], 'namespace' => 'App\Modules\Doubt\Controllers'], function() {

    Route::get('/admin/doubt/list', 'DoubtController@listDoubt')->middleware('permission:view.doubts');
    Route::get('/admin/doubt/data', 'DoubtController@doubtData')->middleware('permission:view.doubts');

    Route::get('/admin/doubt/view/{id}', 'DoubtController@viewDoubt')->middleware('permission:view.doubts');
});
