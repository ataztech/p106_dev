<?php

Route::group(['module' => 'Topic', 'middleware' => ['web'], 'namespace' => 'App\Modules\Topic\Controllers'], function() {

    Route::get('/admin/topic/list', 'TopicController@listTopic')->middleware('permission:view.topics');
    Route::get('/admin/topic/data', 'TopicController@data')->middleware('permission:view.topics');

    Route::get('/admin/topic/create', 'TopicController@create')->middleware('permission:create.topics');
    Route::post('/admin/topic/create', 'TopicController@create')->middleware('permission:create.topics');

    Route::get('/admin/topic/update/{id}', 'TopicController@update')->middleware('permission:update.topics');
    Route::post('/admin/topic/update/{id}', 'TopicController@update')->middleware('permission:update.topics');

    Route::get('/admin/topic/delete/{id}', 'TopicController@delete')->middleware('permission:delete.topics');

    Route::get('/admin/topic/get/chapter', 'TopicController@getChapter')->middleware('permission:delete.question-answers');
    Route::get('/admin/topic/update/get/chapter', 'TopicController@getChapter')->middleware('permission:delete.question-answers');
});
