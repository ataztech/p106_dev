<?php

Route::group(['module' => 'Subject', 'middleware' => ['web'], 'namespace' => 'App\Modules\Subject\Controllers'], function() {

    Route::get('/admin/subject/list', 'SubjectController@list')->middleware('permission:view.subjects');
    Route::get('/admin/subject/data', 'SubjectController@data')->middleware('permission:view.subjects');

    Route::get('/admin/subject/create', 'SubjectController@create')->middleware('permission:create.subjects');
    Route::post('/admin/subject/create', 'SubjectController@create')->middleware('permission:create.subjects');

    Route::get('/admin/subject/update/{id}', 'SubjectController@update')->middleware('permission:update.subjects');
    Route::post('/admin/subject/update/{id}', 'SubjectController@update')->middleware('permission:update.subjects');

    Route::get('/admin/subject/delete/{id}', 'SubjectController@delete')->middleware('permission:delete.subjects');


});
