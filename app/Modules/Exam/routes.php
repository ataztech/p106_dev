<?php

Route::group(['module' => 'Exam', 'middleware' => ['web'], 'namespace' => 'App\Modules\Exam\Controllers'], function() {

    Route::get('/admin/exam/list', 'ExamController@listExam')->middleware('permission:view.exams');
    Route::get('/admin/exam/data', 'ExamController@data')->middleware('permission:view.exams');

    Route::get('/admin/exam/create', 'ExamController@create')->middleware('permission:create.exams');
    Route::post('/admin/exam/create', 'ExamController@create')->middleware('permission:create.exams');

    Route::get('/admin/exam/update/{id}', 'ExamController@update')->middleware('permission:update.exams');
    Route::post('/admin/exam/update/{id}', 'ExamController@update')->middleware('permission:update.exams');

    Route::get('/admin/exam/delete/{id}', 'ExamController@delete')->middleware('permission:delete.exams');
    Route::get('/admin/exam/delete-question/{id}/{test_id}', 'ExamController@deleteQuestion')->middleware('permission:delete.exams');

    Route::get('/admin/exam/set/{id}', 'ExamController@setTest')->middleware('permission:view.exams');
    Route::get('/admin/exam/set/test/{exam_id}', 'ExamController@getTest')->middleware('permission:view.exams');

    Route::get('/admin/test/create/{exam_id}', 'ExamController@createTest')->middleware('permission:view.exams');
    Route::post('/admin/test/create/{exam_id}', 'ExamController@createTest')->middleware('permission:view.exams');

    Route::get('/admin/test/update/{exam_id}', 'ExamController@updateTest')->middleware('permission:view.exams');
    Route::post('/admin/test/update/{exam_id}', 'ExamController@updateTest')->middleware('permission:view.exams');

    Route::get('/admin/test/create/get/subject', 'ExamController@getSubject')->middleware('permission:view.exams');
    Route::get('/admin/test/create/get/chapter', 'ExamController@getChapter')->middleware('permission:view.exams');
    Route::get('/admin/test/create/get/question', 'ExamController@getQuestion')->middleware('permission:view.exams');

    Route::get('/admin/test/update/get/subject', 'ExamController@getSubject')->middleware('permission:view.exams');
    Route::get('/admin/test/update/get/chapter', 'ExamController@getChapter')->middleware('permission:view.exams');
    Route::get('/admin/test/update/get/question', 'ExamController@getQuestion')->middleware('permission:view.exams');
    Route::post('/admin/delete/test/question', 'ExamController@deleteTestQuestions')->middleware('permission:view.exams');
    Route::get('/admin/test/add-new-questions/{exam_id}/{test_id}', 'ExamController@updateTestAddQuestions')->middleware('permission:view.exams');
    Route::post('/admin/test/add-new-questions/{exam_id}/{test_id}', 'ExamController@updateTestAddQuestions')->middleware('permission:view.exams');
});
