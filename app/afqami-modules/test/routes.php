<?php
Route::group(array('module'=>'test','namespace' => 'App\AfqamiModules\test\Controllers'), function() {
    
    Route::get('/test', 'TestController@test');

});