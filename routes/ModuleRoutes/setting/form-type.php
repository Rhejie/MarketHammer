<?php


Route::group(['prefix' => 'form-type', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('get-form-type', 'FormTypeController@index');
    Route::post('store-form-type', 'FormTypeController@store');
    Route::post('update-form-type/{id}', 'FormTypeController@update');
    Route::post('delete-form-type/{id}', 'FormTypeController@destroy');
});