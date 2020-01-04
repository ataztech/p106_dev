<?php

Route::group(['module' => 'Board', 'middleware' => ['web'], 'namespace' => 'App\Modules\Board\Controllers'], function() {

    Route::get('/admin/board/list', 'BoardController@list')->middleware('permission:view.boards');
    Route::get('/admin/board/data', 'BoardController@data')->middleware('permission:view.boards');

    Route::get('/admin/board/create', 'BoardController@create')->middleware('permission:create.boards');
    Route::post('/admin/board/create', 'BoardController@create')->middleware('permission:create.boards');

    Route::get('/admin/board/update/{id}', 'BoardController@update')->middleware('permission:update.boards');
    Route::post('/admin/board/update/{id}', 'BoardController@update')->middleware('permission:update.boards');

    Route::get('/admin/board/delete/{id}', 'BoardController@delete')->middleware('permission:delete.boards');


});
