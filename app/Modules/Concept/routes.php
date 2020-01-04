<?php

Route::group(['module' => 'Concept', 'middleware' => ['web'], 'namespace' => 'App\Modules\Concept\Controllers'], function() {

    Route::get('/admin/concept/list', 'ConceptController@listConcept')->middleware('permission:view.concepts');
    Route::get('/admin/concept/data', 'ConceptController@data')->middleware('permission:view.concepts');

    Route::get('/admin/concept/create', 'ConceptController@upload')->middleware('permission:create.concepts');
    Route::post('/admin/concept/create', 'ConceptController@upload')->middleware('permission:create.concepts');
//    Route::post('/admin/concept/create', 'ConceptController@create')->middleware('permission:create.concepts');
//    Route::post('/admin/concept/create', 'ConceptController@create')->middleware('permission:create.concepts');

    Route::get('/admin/concept/update/{id}', 'ConceptController@update')->middleware('permission:update.concepts');
    Route::post('/admin/concept/update/{id}', 'ConceptController@update')->middleware('permission:update.concepts');

    Route::get('/admin/concept/delete/{id}', 'ConceptController@delete')->middleware('permission:delete.concepts');

    Route::get('/admin/concept/get/subject', 'ConceptController@getSubject')->middleware('permission:delete.concepts');
    Route::get('/admin/concept/get/chapter', 'ConceptController@getChapter')->middleware('permission:delete.concepts');
    Route::get('/admin/concept/get/topic', 'ConceptController@getTopic')->middleware('permission:delete.concepts');

    Route::get('/admin/concept/update/get/subject', 'ConceptController@getSubject')->middleware('permission:delete.concepts');
    Route::get('/admin/concept/update/get/chapter', 'ConceptController@getChapter')->middleware('permission:delete.concepts');
});
