<?php

Route::group(['module' => 'TeacherDashboard', 'middleware' => ['web'], 'namespace' => 'App\Modules\TeacherDashboard\Controllers'], function() {
    Route::get('/teacher/dashboard', 'TeacherDashboardController@index');
});
