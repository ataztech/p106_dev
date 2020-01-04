<?php

Route::group(['module' => 'Standard', 'middleware' => ['web'], 'namespace' => 'App\Modules\Standard\Controllers'], function() {

    Route::get('/admin/standard/list', 'StandardController@list')->middleware('permission:view.standards');
    Route::get('/admin/standard/data', 'StandardController@data')->middleware('permission:view.standards');

    Route::get('/admin/standard/create', 'StandardController@create')->middleware('permission:create.standards');
    Route::post('/admin/standard/create', 'StandardController@create')->middleware('permission:create.standards');

    Route::get('/admin/standard/update/{id}', 'StandardController@update')->middleware('permission:update.standards');
    Route::post('/admin/standard/update/{id}', 'StandardController@update')->middleware('permission:update.standards');

    Route::get('/admin/standard/delete/{id}', 'StandardController@delete')->middleware('permission:delete.standards');


});
