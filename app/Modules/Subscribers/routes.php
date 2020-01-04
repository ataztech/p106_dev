<?php

Route::group(['module' => 'Subscribers', 'middleware' => ['web'], 'namespace' => 'App\Modules\Subscribers\Controllers'], function() {

   Route::get('/admin/subscribers/list','SubscribersController@subscibersList');
   Route::post('/insert/subscribers', 'SubscribersController@getSubscribers');   
   Route::post('/check/duplicate/number', 'SubscribersController@checkDuplicateNumber');
   Route::get('/admin/subscribers/data', 'SubscribersController@subscribersData');

});
