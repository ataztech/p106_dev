<?php

Route::group(['module' => 'Globalvalue', 'middleware' => ['web'], 'namespace' => 'App\Modules\Globalvalue\Controllers'], function() {

    Route::get('/admin/manage-global-value', 'GlobalvaluesController@listGlobalValues')->middleware('permission:view.global.values');
    Route::get('/admin/get-global-value-data', 'GlobalvaluesController@globalValueData')->middleware('permission:view.global.values');
//
    Route::get('/admin/global-value/update/{id}', 'GlobalvaluesController@updateGlobalValue')->middleware('permission:update.global.values');
    Route::post('/admin/global-value/update/{id}', 'GlobalvaluesController@updateGlobalValue')->middleware('permission:update.global.values');

});
