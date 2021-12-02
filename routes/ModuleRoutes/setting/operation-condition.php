<?php


Route::group(['prefix' => 'operation-condition', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('get-operation-condition', 'OperationConditionController@index');
    Route::post('store-operation-condition', 'OperationConditionController@store');
    Route::post('update-operation-condition/{id}', 'OperationConditionController@update');
    Route::post('delete-operation-condition/{id}', 'OperationConditionController@destroy');
});