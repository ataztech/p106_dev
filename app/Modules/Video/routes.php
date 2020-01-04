<?php

Route::group(['module' => 'Video', 'middleware' => ['web'], 'namespace' => 'App\Modules\Video\Controllers'], function() {

    Route::get('/admin/video/list', 'VideoController@listVideo')->middleware('permission:view.videos');
    Route::get('/admin/video/data', 'VideoController@data')->middleware('permission:view.videos');

    Route::get('/admin/video/create', 'VideoController@create')->middleware('permission:create.videos');
    Route::post('/admin/video/create', 'VideoController@create')->middleware('permission:create.videos');

    Route::get('/admin/video/update/{id}', 'VideoController@update')->middleware('permission:update.videos');
    Route::post('/admin/video/update/{id}', 'VideoController@update')->middleware('permission:update.videos');

    Route::get('/admin/video/delete/{id}', 'VideoController@delete')->middleware('permission:delete.videos');

    Route::get('/admin/video/get/subject', 'VideoController@getSubject')->middleware('permission:delete.videos');
    Route::get('/admin/video/get/chapter', 'VideoController@getChapter')->middleware('permission:delete.videos');
    Route::get('/admin/video/get/topic', 'VideoController@getTopic')->middleware('permission:delete.videos');

    Route::get('/admin/video/update/get/subject', 'VideoController@getSubject')->middleware('permission:delete.videos');
    Route::get('/admin/video/update/get/chapter', 'VideoController@getChapter')->middleware('permission:delete.videos');
    Route::get('/admin/video/update/get/topic', 'VideoController@getTopic')->middleware('permission:delete.videos');


});
