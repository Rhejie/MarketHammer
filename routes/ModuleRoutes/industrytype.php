<?php

Route::group(['prefix' => 'industry-type', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function() {
    Route::get('{id}', 'IndustryTypeController@show');
    Route::put('{id}', 'IndustryTypeController@update');
    Route::delete('{id}', 'IndustryTypeController@destroy');
    Route::resource('', 'IndustryTypeController');
    Route::post('/import', 'IndustryTypeController@importIndustry');
});