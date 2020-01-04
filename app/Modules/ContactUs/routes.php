<?php

Route::group(['module' => 'ContactUs', 'middleware' => ['web'], 'namespace' => 'App\Modules\ContactUs\Controllers'], function() {

    Route::get('/admin/contactus/list', 'ContactUsController@listContactUs')->middleware('permission:view.contactus');
// Route::get('/admin/contactus/list', function(){dd(34);})->middleware('permission:view.contactus');
    Route::get('/admin/contactus/data', 'ContactUsController@contactusData')->middleware('permission:view.contactus');
//
    Route::get('/admin/contactus/reply/{id}', 'ContactUsController@updateContactUs')->middleware('permission:reply.contactus');
    Route::post('/admin/contactus/reply/{id}', 'ContactUsController@updateContactUs')->middleware('permission:reply.contactus');

});
