<?php

Route::group(['module' => 'Student', 'middleware' => ['web'], 'namespace' => 'App\Modules\Student\Controllers'], function() {

    Route::get('/admin/student/list', 'StudentController@list')->middleware('permission:view.students');
    Route::get('/admin/student/data', 'StudentController@data')->middleware('permission:view.students');

    Route::get('/admin/student/create', 'StudentController@create')->middleware('permission:create.students');
    Route::post('/admin/student/create', 'StudentController@create')->middleware('permission:create.students');

    Route::get('/admin/student/update/{id}', 'StudentController@update')->middleware('permission:update.students');
    Route::post('/admin/student/update/{id}', 'StudentController@update')->middleware('permission:update.students');

    Route::get('/admin/student/delete/{id}', 'StudentController@delete')->middleware('permission:delete.students');
    Route::get('/make/temperory/{id}','StudentController@makeTemperory');


});
