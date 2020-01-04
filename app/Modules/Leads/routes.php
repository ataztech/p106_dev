<?php

Route::group(['module' => 'Leads', 'middleware' => ['web'], 'namespace' => 'App\Modules\Leads\Controllers'], function() {

    Route::get('/admin/leads/list','LeadsController@leadList');
    Route::get('/admin/leads/data','LeadsController@leadsData');
    Route::get('/make/permanent/{id}','LeadsController@makePermanentUser');



});
