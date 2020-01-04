<?php

 Route::group(['module' => 'User', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\User\Controllers'], function() {
    Route::get('/admin/user/list', 'UserController@list')->middleware('permission:view.users');
    Route::get('/admin/user/data', 'UserController@data')->middleware('permission:view.users');
    Route::get('/admin/user/create', 'UserController@create')->middleware('permission:create.users');
    Route::post('/admin/user/create', 'UserController@create')->middleware('permission:create.users');
    Route::get('/admin/user/update/{id}', 'UserController@update')->middleware('permission:update.users');
    Route::post('/admin/user/update/{id}', 'UserController@update')->middleware('permission:update.users');
    Route::get('/admin/user/delete/{id}', 'UserController@delete')->middleware('permission:delete.users');
    
    
    //front end routes
    Route::get('/user/profile', 'UserController@profile');
    Route::post('/user/profile', 'UserController@updateProfile');
    Route::post('/user/update-password', 'UserController@updatePassword');
//    Route::get('/user/profile', 'UserController@profile');
    Route::get('/user/syllabus', 'UserController@userSyllabus');

});
