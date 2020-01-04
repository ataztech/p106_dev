<?php

Route::group(['module' => 'Price', 'middleware' => ['web'], 'namespace' => 'App\Modules\Price\Controllers'], function() {

    Route::get('/admin/price/list', 'PriceController@list')->middleware('permission:view.prices');
    Route::get('/admin/price/data', 'PriceController@data')->middleware('permission:view.prices');

    Route::get('/admin/price/create', 'PriceController@create')->middleware('permission:create.prices');
    Route::post('/admin/price/create', 'PriceController@create')->middleware('permission:create.prices');

    Route::get('/admin/price/update/{id}', 'PriceController@update')->middleware('permission:update.prices');
    Route::post('/admin/price/update/{id}', 'PriceController@update')->middleware('permission:update.prices');

    Route::get('/admin/price/delete/{id}', 'PriceController@delete')->middleware('permission:delete.prices');


});
