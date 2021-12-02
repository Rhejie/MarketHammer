<?php


Route::group(['prefix' => 'business-qsa', 'namespace' => 'BackOffice'], function() {
    Route::match(['post', 'get'], 'get-list', 'Business\BusinessQsaController@getCustomFields')->name('get-list');
    Route::get('{id}', 'Business\BusinessQsaController@show');
    Route::put('{id}', 'Business\BusinessQsaController@update');
    Route::delete('{id}', 'Business\BusinessQsaController@destroy');
    Route::resource('', 'Business\BusinessQsaController');
});