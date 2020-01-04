<?php

Route::group(['module' => 'LoginHistory', 'middleware' => ['web'], 'namespace' => 'App\Modules\LoginHistory\Controllers'], function() {

    Route::get('/admin/login-history/list','LoginHistoryController@loginHistoryList');
    Route::get('/admin/login-history/data','LoginHistoryController@loginHistoryData');
    



});
