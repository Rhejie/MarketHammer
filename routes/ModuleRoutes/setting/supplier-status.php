<?php


Route::group(['prefix' => 'supplier-status', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('get-supplier-status', 'SupplierStatusController@index');
    Route::post('store-supplier-status', 'SupplierStatusController@store');
    Route::post('update-supplier-status/{id}', 'SupplierStatusController@update');
    Route::post('delete-supplier-status/{id}', 'SupplierStatusController@destroy');
});