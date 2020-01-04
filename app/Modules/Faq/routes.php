<?php

Route::group(['module' => 'Faq', 'middleware' => ['web'], 'namespace' => 'App\Modules\Faq\Controllers'], function() {

    Route::get('/admin/faq/list', 'FaqController@list')->middleware('permission:view.faqs');
    Route::get('/admin/faq/data', 'FaqController@data')->middleware('permission:view.faqs');

    Route::get('/admin/faq/create', 'FaqController@create')->middleware('permission:create.faqs');
    Route::post('/admin/faq/create', 'FaqController@create')->middleware('permission:create.faqs');

    Route::get('/admin/faq/update/{id}', 'FaqController@update')->middleware('permission:update.faqs');
    Route::post('/admin/faq/update/{id}', 'FaqController@update')->middleware('permission:update.faqs');

    Route::get('/admin/faq/delete/{id}', 'FaqController@delete')->middleware('permission:delete.faqs');


});
