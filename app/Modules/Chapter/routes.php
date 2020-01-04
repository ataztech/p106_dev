<?php

Route::group(['module' => 'Chapter', 'middleware' => ['web'], 'namespace' => 'App\Modules\Chapter\Controllers'], function() {

    Route::get('/admin/chapter/list', 'ChapterController@list')->middleware('permission:view.chapters');
    Route::get('/admin/chapter/data', 'ChapterController@data')->middleware('permission:view.chapters');

    Route::get('/admin/chapter/create', 'ChapterController@create')->middleware('permission:create.chapters');
    Route::post('/admin/chapter/create', 'ChapterController@create')->middleware('permission:create.chapters');

    Route::get('/admin/chapter/update/{id}', 'ChapterController@update')->middleware('permission:update.chapters');
    Route::post('/admin/chapter/update/{id}', 'ChapterController@update')->middleware('permission:update.chapters');

    Route::get('/admin/chapter/delete/{id}', 'ChapterController@delete')->middleware('permission:delete.chapters');


});
