<?php

Route::group(['prefix' => 'role-permission', 'namespace' => 'RolePermission'], function() {
	Route::match(['post', 'get'], 'get-role-permission', 'RolePermissionController@getRolePermission')->name('get-role-permission');
	Route::post('save', 'RolePermissionController@savePermission')->name('save');
	Route::post('remove', 'RolePermissionController@removePermission')->name('remove');
    Route::resource('', 'RolePermissionController');
});