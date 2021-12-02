<?php

Route::group(['prefix' => 'business-type', 'namespace' => 'BackOffice'], function() {
    // Route::get('{id}', 'BusinessTypeController@show');
    // Route::put('{id}', 'BusinessTypeController@update');
    // Route::delete('{id}', 'BusinessTypeController@destroy');
    Route::post('/delete', 'BusinessTypeController@delete');
    Route::resource('/', 'BusinessTypeController');
});