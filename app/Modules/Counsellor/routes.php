<?php

Route::group(['module' => 'Counsellor', 'middleware' => ['web'], 'namespace' => 'App\Modules\Counsellor\Controllers'], function() {

    Route::get('/admin/counsellor/list','CounsellorController@counsellorList');
    Route::get('/admin/counsellor/data','CounsellorController@counsellorData');
    Route::get('/admin/counsellor/create','CounsellorController@create');
    Route::post('/admin/counsellor/create','CounsellorController@create');
    Route::get('/check-counsellor-name-duplication','CounsellorController@checkCounsellorNameDuplication');
    Route::get('/admin/counsellor/update/{id}','CounsellorController@update');
    Route::post('/admin/counsellor/update/{id}','CounsellorController@update');
    Route::get('/admin/counsellor/delete/{id}','CounsellorController@delete');


});
