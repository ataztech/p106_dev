<?php

Route::group(['module' => 'Cms', 'middleware' => ['web'], 'namespace' => 'App\Modules\Cms\Controllers'], function() {

//Global Values routs
    Route::get('/admin/cms/list', 'CmsController@listCms')->middleware('permission:view.cms');
// Route::get('/admin/cms/list', function(){dd(34);})->middleware('permission:view.cms');
    Route::get('/admin/cms/data', 'CmsController@cmsData')->middleware('permission:view.cms');
//
    Route::get('/admin/cms/update/{id}', 'CmsController@updateCms')->middleware('permission:update.cms');
    Route::post('/admin/cms/update/{id}', 'CmsController@updateCms')->middleware('permission:update.cms');

});