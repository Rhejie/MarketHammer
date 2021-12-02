<?php

Route::group(['namespace' => 'BackOffice\User'], function () {
    Route::get('user/get-user/{id}', 'UserController@getUser');
    Route::get('user/get-suppliers/{query}', 'UserController@getSupplier');
    Route::get('/user/check-user-type/{id}', 'UserController@checkUserType');
    Route::match(['post', 'get'], 'user/get-users', 'UserController@getUsers')->name('user.get-users');
    Route::match(['post', 'get'], 'user/set-user-locale', 'UserController@setUserLocale')->name('user.set-user-locale');
    Route::resource('user', 'UserController')->middleware('isAdmin');
});
