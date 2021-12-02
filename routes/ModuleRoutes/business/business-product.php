<?php

Route::group(['prefix' => 'business-product', 'namespace' => 'BackOffice'], function() {
    Route::get('{id}', 'Business\BusinessProductController@show');
    Route::put('{id}', 'Business\BusinessProductController@update');
    Route::delete('{id}', 'Business\BusinessProductController@destroy');
    Route::resource('', 'Business\BusinessProductController');
});
