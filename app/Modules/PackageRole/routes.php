<?php

Route::group(['module' => 'Role', 'middleware' => ['web'], 'namespace' => 'App\Modules\PackageRole\Controllers'], function() {

    Route::get('/admin/package-role/list', 'PackageRoleController@list')->middleware('permission:view.package-roles');
    Route::get('/admin/package-role/data', 'PackageRoleController@data')->middleware('permission:view.package-roles');

    Route::get('/admin/package-role/create', 'PackageRoleController@create')->middleware('permission:create.package-roles');
    Route::post('/admin/package-role/create', 'PackageRoleController@create')->middleware('permission:create.package-roles');

    Route::get('/admin/package-role/update/{id}', 'PackageRoleController@update')->middleware('permission:update.package-roles');
    Route::post('/admin/package-role/update/{id}', 'PackageRoleController@update')->middleware('permission:update.package-roles');

    Route::get('/admin/package-role/delete/{id}', 'PackageRoleController@delete')->middleware('permission:delete.package-roles');

//permission
    Route::get('/admin/package-role/permission/set/{id}', 'PackageRoleController@setPermission')->middleware('permission:set.permissions');
    Route::post('/admin/package-role/permission/set/{id}', 'PackageRoleController@setPermission')->middleware('permission:set.permissions');


});
