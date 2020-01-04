<?php

Route::group(['module' => 'Emailtemplate', 'middleware' => ['web'], 'namespace' => 'App\Modules\Emailtemplate\Controllers'], function() {

    Route::get('/admin/emailtemplate/list', 'EmailtemplateController@listEmailTemplate')->middleware('permission:view.emailtemplates');
// Route::get('/admin/emailtemplate/list', function(){dd(34);})->middleware('permission:view.emailtemplate');
    Route::get('/admin/emailtemplate/data', 'EmailtemplateController@emailtemplateData')->middleware('permission:view.emailtemplates');
//
    Route::get('/admin/emailtemplate/update/{id}', 'EmailtemplateController@updateEmailTemplate')->middleware('permission:update.emailtemplates');
    Route::post('/admin/emailtemplate/update/{id}', 'EmailtemplateController@updateEmailTemplate')->middleware('permission:update.emailtemplates');


});
