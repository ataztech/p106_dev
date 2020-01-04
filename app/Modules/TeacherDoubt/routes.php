<?php

Route::group(['module' => 'TeacherDoubt', 'middleware' => ['web'], 'namespace' => 'App\Modules\TeacherDoubt\Controllers'], function() {

    Route::get('/teacher/doubt/list', 'TeacherDoubtController@listDoubt');
    Route::get('/teacher/doubt/data', 'TeacherDoubtController@doubtData');

    Route::get('/teacher/doubt/view/{id}', 'TeacherDoubtController@viewDoubt');
    Route::post('/teacher/doubt/reply/{id}', 'TeacherDoubtController@replyDoubt');
});
