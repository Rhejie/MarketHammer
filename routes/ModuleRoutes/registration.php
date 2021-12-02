<?php

Route::group(['prefix' => 'register', 'namespace' => 'Auth'], function() {
    Route::post('/register-supplier', 'RegisterController@registerSupplier')->name('register.register-supplier');
    Route::post('/register-user', 'RegisterController@registerUser')->name('register.register-user');
});