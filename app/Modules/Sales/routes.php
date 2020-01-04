<?php

Route::group(['module' => 'Sales', 'middleware' => ['web'], 'namespace' => 'App\Modules\Sales\Controllers'], function() {

    Route::get('/admin/sales/list','SalesController@salesList');
    Route::get('/admin/sales/data','SalesController@salesData');
    Route::get('/admin/sales/create','SalesController@create');
    Route::post('/admin/sales/create','SalesController@create');
    Route::get('/admin/sales/update/{id}','SalesController@update');
    Route::post('/admin/sales/update/{id}','SalesController@update');
    Route::get('/admin/sales/delete/{id}','SalesController@delete');
    Route::get('/admin/total-sales','SalesController@totalSales');


});
