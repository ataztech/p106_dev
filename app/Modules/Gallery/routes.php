<?php

Route::group(['module' => 'Gallery', 'middleware' => ['web'], 'namespace' => 'App\Modules\Gallery\Controllers'], function() {

   Route::get('/admin/gallery/list','GalleryController@galleryList');
   Route::get('/admin/create/gallery','GalleryController@createGallery');
   Route::post('/admin/create/gallery','GalleryController@createGallery');
   Route::get('/admin/gallery/data','GalleryController@galleryData');

});
