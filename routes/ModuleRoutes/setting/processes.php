<?php


Route::group(['prefix' => 'processes', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('get-processes', 'ProcessessController@index');
    Route::get('get-process_type', 'ProcessessController@processType');
    Route::post('store-processes', 'ProcessessController@store');
    Route::post('update-process/{id}', 'ProcessessController@update');
    Route::post('delete-processes/{id}', 'ProcessessController@destroy');
});
