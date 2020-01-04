<?php

Route::group(['module' => 'QuestionAnswer', 'middleware' => ['web'], 'namespace' => 'App\Modules\QuestionAnswer\Controllers'], function() {

    Route::post('/get/ck/image', 'QuestionAnswerController@getCkImage')->middleware('permission:view.question-answers');
    Route::get('/admin/question-answer/list', 'QuestionAnswerController@list')->middleware('permission:view.question-answers');
    Route::get('/admin/question-answer/data', 'QuestionAnswerController@data')->middleware('permission:view.question-answers');

    Route::get('/admin/question-answer/create', 'QuestionAnswerController@create')->middleware('permission:create.question-answers');
    Route::post('/admin/question-answer/create', 'QuestionAnswerController@create')->middleware('permission:create.question-answers');

    Route::get('/admin/question-answer/update/{id}', 'QuestionAnswerController@update')->middleware('permission:update.question-answers');
    Route::post('/admin/question-answer/update/{id}', 'QuestionAnswerController@update')->middleware('permission:update.question-answers');

    Route::get('/admin/question-answer/delete/{id}', 'QuestionAnswerController@delete')->middleware('permission:delete.question-answers');

    Route::get('/admin/question-answer/get/subject', 'QuestionAnswerController@getSubject')->middleware('permission:delete.question-answers');
    Route::get('/admin/question-answer/get/chapter', 'QuestionAnswerController@getChapter')->middleware('permission:delete.question-answers');
    Route::get('/admin/question-answer/get/topic', 'QuestionAnswerController@getTopic')->middleware('permission:delete.question-answers');

    Route::get('/admin/question-answer/update/get/subject', 'QuestionAnswerController@getSubject')->middleware('permission:delete.question-answers');
    Route::get('/admin/question-answer/update/get/chapter', 'QuestionAnswerController@getChapter')->middleware('permission:delete.question-answers');
    Route::get('/admin/question-answer/update/get/topic', 'QuestionAnswerController@getTopic')->middleware('permission:delete.question-answers');


});
