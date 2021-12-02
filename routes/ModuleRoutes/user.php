<?php

Route::group(['prefix' => 'user', 'namespace' => 'Home'], function () {
    Route::post('/upload-profile-picture', 'UsersController@importProfilePicture');
    Route::post('/save-profile', 'UsersController@saveProfile');
    Route::post('/change-password', 'UsersController@changePassword');
    Route::post('/get-logged-user', 'UsersController@getLoggedUser');
    Route::resource('/', 'UsersController');
});
