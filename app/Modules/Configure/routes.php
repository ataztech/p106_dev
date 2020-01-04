<?php

Route::group(['module' => 'Configure', 'middleware' => ['web','auth','userexpiration'], 'namespace' => 'App\Modules\Configure\Controllers'], function() {

    Route::get('/user/configure/class', 'ConfigureController@configureClass');
    Route::get('/user/configure/save-class/{id}', 'ConfigureController@saveConfigureClass');
    Route::get('/user/configure/board', 'ConfigureController@configureBoard');
    Route::get('/user/configure/save-board', 'ConfigureController@saveConfigureBoard');
    Route::get('/user/configure/stream', 'ConfigureController@configureStream');
    Route::get('/user/configure/save-stream/{stream}', 'ConfigureController@saveConfigureStream');
    Route::get('/user/configure/prepare', 'ConfigureController@configurePrepare');
    Route::get('/user/configure/save-prepare', 'ConfigureController@saveConfigurePrepare');
    Route::get('/user/configure/exam1', 'ConfigureController@configureExam1');
    Route::get('/user/configure/exam', 'ConfigureController@configureExam');
    Route::get('/user/configure/save-exam', 'ConfigureController@saveConfigureExam');
    Route::get('/user/configure/exam3', 'ConfigureController@configureExam3');
    Route::get('/user/configure/subjects', 'ConfigureController@configureSubjects');
    


});
