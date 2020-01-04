<?php

Route::group(['module' => 'Teacher', 'middleware' => ['web'], 'namespace' => 'App\Modules\Teacher\Controllers'], function() {

    Route::get('/admin/teacher/list', 'TeacherController@listTeacher')->middleware('permission:view.teachers');
    Route::get('/admin/teacher/data', 'TeacherController@data')->middleware('permission:view.teachers');

    Route::get('/admin/teacher/create', 'TeacherController@create')->middleware('permission:create.teachers');
    Route::post('/admin/teacher/create', 'TeacherController@create')->middleware('permission:create.teachers');

    Route::get('/admin/teacher/update/{id}', 'TeacherController@update')->middleware('permission:update.teachers');
    Route::post('/admin/teacher/update/{id}', 'TeacherController@update')->middleware('permission:update.teachers');

    Route::get('/admin/teacher/delete/{id}', 'TeacherController@delete')->middleware('permission:delete.teachers');


});
