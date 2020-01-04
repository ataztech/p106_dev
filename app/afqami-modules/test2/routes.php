<?php
Route::group(array('module'=>'test2','namespace' => 'App\AfqamiModules\test2\Controllers'), function() {
    
    
    Route::get('/test2', 'Test2Controller@test');

});