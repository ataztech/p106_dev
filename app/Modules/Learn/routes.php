<?php

Route::group(['module' => 'Learn', 'middleware' => ['web','auth','userexpiration','userstate'], 'namespace' => 'App\Modules\Learn\Controllers'], function() {

    Route::get('/user/learn/{subject_id}', 'LearnController@chapterList');
    Route::get('/user/learn/{subject_id}/topic/{chapter_id}', 'LearnController@chapterTopicList');
    Route::get('/user/learn/{subject_id}/topic/{chapter_id}/test/{topic_id}', 'LearnController@chapterTopicAssess');
    Route::get('/user/learn/{subject_id}/topic/{chapter_id}/video/{topic_id}/{video_id}', 'LearnController@chapterTopicVideo');
    Route::get('/user/learn/{subject_id}/topic/{chapter_id}/questions/{level}', 'LearnController@getChapterDifficultyQuestions');
    Route::get('/topic/top-ten/next-question/{chapter_id}/{level}', 'LearnController@nextTopTenQuestion');
    Route::get('/user/learn/{subject_id}/ncert/{chapter_id}', 'LearnController@ncertSolutions');
    Route::get('/user/learn/{subject_id}/previous-papers/{chapter_id}', 'LearnController@previousPapers');
    Route::get('/topic/test/get-answer', 'LearnController@getAnswer');
    Route::get('/topic/test/next-question', 'LearnController@nextQuestion');
    Route::get('/topic/test/get-report/{topic_id}/{chapter_id}', 'LearnController@getReport');
    Route::get('/topic/test/ajax-puase-get-report', 'LearnController@ajaxGetPauseReport');
    Route::get('/submit/report/test', 'LearnController@submitReport');
    Route::get('/topic/test/reset/{topic_id}/{chapter_id}/{subject_id}', 'LearnController@resetTest');
    Route::get('/bookmark/question', 'LearnController@bookMarkQuestion');
    Route::get('/bookmark/concept', 'LearnController@bookMarkConcept');
    Route::get('/bookmark/video', 'LearnController@bookMarkVideo');
    Route::get('/tools/bookmarks', 'LearnController@bookMarkHome');
    Route::get('/tools/bookmarks/subject/{subject_id}', 'LearnController@subjectBookmarks');
    
    
    //examiner routes goes here
    
    Route::get('examiner/user/learn/{subject_id}', 'LearnController@examinerChapterList');
    Route::get('examiner/user/learn/{subject_id}/topic/{chapter_id}', 'LearnController@examinerChapterTopicList');
    Route::get('examiner/user/learn/{subject_id}/topic/{chapter_id}/test/{topic_id}', 'LearnController@examinerChapterTopicAssess');
    Route::get('examiner/topic/test/next-question', 'LearnController@examinerNextQuestion');
    Route::get('examiner/topic/test/send-report', 'LearnController@examinerSendReport');
    
});
