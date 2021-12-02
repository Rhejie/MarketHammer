<?php

Route::group(['prefix' => 'register', 'namespace' => 'Auth'], function() {
    Route::post('/register-user', 'RegisterController@registerUser')->name('register.register-user');
});