<?php
Route::group(array('module'=>'test3','namespace' => 'App\AfqamiModules\test3\Controllers'), function() {
    
    
    Route::get('/test3', 'Test3Controller@test');

});