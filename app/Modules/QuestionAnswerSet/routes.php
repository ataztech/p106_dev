<?php

Route::group(['module' => 'QuestionAnswerSet', 'middleware' => ['web'], 'namespace' => 'App\Modules\QuestionAnswerSet\Controllers'], function() {

    Route::get('/admin/question-answer-set/list', 'QuestionAnswerSetController@listQuestionAnswerSet')->middleware('permission:view.question-answer-sets');
    Route::get('/admin/question-answer-set/data', 'QuestionAnswerSetController@data')->middleware('permission:view.question-answer-sets');
    
//    NCRT Solution Routes
    Route::get('/admin/question-answer-sets/ncrt-solutions/{chapter_id}', 'QuestionAnswerSetController@listNcrtSolution')->middleware('permission:view.question-answer-sets');
    Route::get('/admin/question-answer-set/ncrt-solution/data/{chapter_id}', 'QuestionAnswerSetController@NcrtSolutiondata')->middleware('permission:view.question-answer-sets');
    
    Route::get('/admin/question-answer-sets/ncrt-solutions/{chapter_id}/create', 'QuestionAnswerSetController@upload')->middleware('permission:create.question-answer-sets');
    Route::post('/admin/question-answer-sets/ncrt-solutions/{chapter_id}/create', 'QuestionAnswerSetController@upload')->middleware('permission:create.question-answer-sets');

    Route::get('/admin/question-answer-sets/ncrt-solutions/{ncrt_id}/update', 'QuestionAnswerSetController@update')->middleware('permission:update.question-answer-sets');
    Route::post('/admin/question-answer-sets/ncrt-solutions/{ncrt_id}/update', 'QuestionAnswerSetController@update')->middleware('permission:update.question-answer-sets');

    Route::get('/admin/question-answer-sets/ncrt-solutions/delete/{id}', 'QuestionAnswerSetController@delete')->middleware('permission:delete.question-answer-sets');
//    End NCRT Solution Routes
    
    Route::get('/admin/question-answer-set/get/subject', 'QuestionAnswerSetController@getSubject')->middleware('permission:delete.question-answer-sets');
    Route::get('/admin/question-answer-set/get/chapter', 'QuestionAnswerSetController@getChapter')->middleware('permission:delete.question-answer-sets');
    Route::get('/admin/question-answer-set/get/topic', 'QuestionAnswerSetController@getTopic')->middleware('permission:delete.question-answer-sets');

    Route::get('/admin/question-answer-set/update/get/subject', 'QuestionAnswerSetController@getSubject')->middleware('permission:delete.question-answer-sets');
    Route::get('/admin/question-answer-set/update/get/chapter', 'QuestionAnswerSetController@getChapter')->middleware('permission:delete.question-answer-sets');
    Route::get('/admin/question-answer-set/update/get/topic', 'QuestionAnswerSetController@getTopic')->middleware('permission:delete.question-answer-sets');
    
    Route::get('/admin/question-answer-sets/top-10/{level}/{chapter_id}', 'QuestionAnswerSetController@setQuestion')->middleware('permission:delete.question-answer-sets');
    Route::post('/admin/question-answer-sets/top-10/{level}/{chapter_id}', 'QuestionAnswerSetController@setQuestion')->middleware('permission:delete.question-answer-sets');    
    
    Route::get('/admin/question-answer-sets/previous-questions/{chapter_id}', 'QuestionAnswerSetController@priviousQuestions')->middleware('permission:delete.question-answer-sets');    
    Route::post('/admin/question-answer-sets/previous-questions/{chapter_id}', 'QuestionAnswerSetController@priviousQuestions')->middleware('permission:delete.question-answer-sets');    

});
