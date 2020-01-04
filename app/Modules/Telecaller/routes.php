<?php

Route::group(['module' => 'Telecaller', 'middleware' => ['web'], 'namespace' => 'App\Modules\Telecaller\Controllers'], function() {

    Route::get('/admin/telecaller/list', 'TelecallerController@listTelecaller')->middleware('permission:view.teachers');
    Route::get('/admin/telecaller/data', 'TelecallerController@data')->middleware('permission:view.teachers');

    Route::get('/admin/telecaller/create', 'TelecallerController@create')->middleware('permission:create.teachers');
    Route::post('/admin/telecaller/create', 'TelecallerController@create')->middleware('permission:create.teachers');

    Route::get('/admin/telecaller/update/{id}', 'TelecallerController@update')->middleware('permission:update.teachers');
    Route::post('/admin/telecaller/update/{id}', 'TelecallerController@update')->middleware('permission:update.teachers');

    Route::get('/admin/telecaller/delete/{id}', 'TelecallerController@delete')->middleware('permission:delete.teachers');

    Route::get('/telecaller/login','TelecallerController@telecallerLogin');
    Route::get('/telecaller/dashboard', 'TelecallerController@telecallerDashboard');


});
