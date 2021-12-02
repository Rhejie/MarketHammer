<?php

Route::group(['prefix' => 'theme', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function() {
    Route::get('{id}', 'ThemeController@show');
    Route::put('{id}', 'ThemeController@update');
    Route::delete('{id}', 'ThemeController@destroy');
    Route::resource('', 'ThemeController');
});