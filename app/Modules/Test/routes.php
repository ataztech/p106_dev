<?php

Route::group(['module' => 'Test', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Test\Controllers'], function() {
    Route::get('tools/tests', 'TestController@tests');
    Route::get('tools/tests/all', 'TestController@AllTests');
    Route::get('tools/test-series/{exam_id}', 'TestController@examTests');
    Route::get('tools/test-series/attempt-test/{test_id}', 'TestController@attempTest');
    Route::get('exam/test/next-question', 'TestController@nextQuestion');
    Route::get('exam/test/submit-answer', 'TestController@submitTestAnswer');
    Route::get('exam/test/ajax-puase-get-report', 'TestController@ajaxGetTestReport');
    Route::get('exam/test/get-report/{test_id}', 'TestController@getTestReport');
});
