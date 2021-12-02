<?php

Route::group(['prefix' => 'business-user-type-permission', 'namespace' => 'RolePermission'], function() {
    Route::match(['post', 'get'], 'get-permission', 'BusinessUserTypePermissionController@getPermission')->name('get-permission');
    Route::delete('{id}', 'BusinessUserTypePermissionController@destroy');
    Route::resource('', 'BusinessUserTypePermissionController');
});