<?php

Route::group(['module' => 'Demo', 'middleware' => ['web'], 'namespace' => 'App\Modules\Demo\Controllers'], function() {

    Route::get('/telecaller/demo/list', 'DemoController@list')->middleware('permission:view.demos');
    Route::get('/telecaller/demo/data', 'DemoController@data')->middleware('permission:view.demos');

    Route::get('/telecaller/demo/create', 'DemoController@create')->middleware('permission:create.demos');
    Route::post('/telecaller/demo/create', 'DemoController@create')->middleware('permission:create.demos');

    Route::get('/telecaller/demo/update/{id}', 'DemoController@update')->middleware('permission:update.demos');
    Route::post('/telecaller/demo/update/{id}', 'DemoController@update')->middleware('permission:update.demos');

    Route::get('/telecaller/demo/delete/{id}', 'DemoController@delete')->middleware('permission:delete.demos');


});
