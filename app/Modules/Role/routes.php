<?php

Route::group(['module' => 'Role', 'middleware' => ['web'], 'namespace' => 'App\Modules\Role\Controllers'], function() {

    Route::get('/admin/role/list', 'RoleController@list')->middleware('permission:view.roles');
    Route::get('/admin/role/data', 'RoleController@data')->middleware('permission:view.roles');

    Route::get('/admin/role/create', 'RoleController@create')->middleware('permission:create.roles');
    Route::post('/admin/role/create', 'RoleController@create')->middleware('permission:create.roles');

    Route::get('/admin/role/update/{id}', 'RoleController@update')->middleware('permission:update.roles');
    Route::post('/admin/role/update/{id}', 'RoleController@update')->middleware('permission:update.roles');

    Route::get('/admin/role/delete/{id}', 'RoleController@delete')->middleware('permission:delete.roles');

//permission
    Route::get('/admin/role/permission/set/{id}', 'RoleController@setPermission')->middleware('permission:set.permissions');
    Route::post('/admin/role/permission/set/{id}', 'RoleController@setPermission')->middleware('permission:set.permissions');
    
    
    
    // Telecaller Roles

    Route::get('/admin/telecaller-role/list','RoleController@listTelecallerRoles');
    Route::get('/admin/telecaller-role/data','RoleController@telecallerRoleData');

    Route::get('/admin/telecaller-role/create','RoleController@createTelecaller');
    Route::post('/admin/telecaller-role/create','RoleController@createTelecaller');

    Route::get('/admin/telecaller-role/update/{id}', 'RoleController@updateTelecaller');
    Route::post('/admin/telecaller-role/update/{id}', 'RoleController@updateTelecaller');

    Route::get('/admin/telecaller-role/delete/{id}', 'RoleController@deleteTelecaller');

    // telecaller permission
    Route::get('/admin/role/telecaller-permission/set/{id}','RoleController@setTelecallerPermission');
    Route::post('/admin/role/telecaller-permission/set/{id}','RoleController@setTelecallerPermission');


});
