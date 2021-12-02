<?php

Route::group(['prefix' => 'business-processes', 'namespace' => 'BackOffice'], function () {
    Route::get('get-business-processes/{id}', 'Business\BusinessProcessesController@showBusinessProcesses');
    Route::get('get-processes-data', 'Business\BusinessProcessesController@getProcessesData');
    Route::post('store-business-processes', 'Business\BusinessProcessesController@store');
    Route::post('delete-processes/{id}', 'Business\BusinessProcessesController@deleteProcesses');
    Route::post('delete-processes-by-name', 'Business\BusinessProcessesController@deleteProcessesByName');
});
