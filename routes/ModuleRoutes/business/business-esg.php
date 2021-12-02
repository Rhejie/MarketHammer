<?php
Route::group(['prefix' => 'esg-list', 'namespace' => 'BackOffice\Business'], function () {
    Route::get('get-esg/{id}', 'BusinessEsgController@index');
    Route::post('store', 'BusinessEsgController@store');
    Route::post('update/{id}', 'BusinessEsgController@update');
    Route::post('delete/{id}', 'BusinessEsgController@destroy');
});