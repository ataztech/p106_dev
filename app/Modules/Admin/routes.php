<?php

Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {

    Route::get('/admin/login', 'AdminController@login')->name('admin');
    Route::get('/admin/dashboard', 'AdminController@index');
    Route::get('/admin/profile', 'AdminController@profile');
    Route::post('/admin/profile', 'AdminController@profile');
    Route::post('/admin/password', 'AdminController@changePassword');
    Route::get('/admin/email', 'AdminController@email');

});
