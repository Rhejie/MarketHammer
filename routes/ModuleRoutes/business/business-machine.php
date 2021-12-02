<?php

Route::group(['prefix' => 'business-machine', 'namespace' => 'BackOffice'], function() {
    Route::match(['post', 'get'], 'get-business-machines', 'Business\BusinessMachineController@getBusinessMachines')->name('get-business-machines');
    Route::get('{id}', 'Business\BusinessMachineController@show');
    Route::put('{id}', 'Business\BusinessMachineController@update');
    Route::delete('{id}', 'Business\BusinessMachineController@destroy');
    Route::resource('', 'Business\BusinessMachineController');
});

Route::group(['prefix' => 'machine-custom-field', 'namespace' => 'BackOffice'], function() {
    Route::match(['post', 'get'], 'get-list', 'Business\BusinessMachineCustomFieldController@getCustomFields')->name('get-list');
    Route::get('{id}', 'Business\BusinessMachineCustomFieldController@show');
    Route::put('{id}', 'Business\BusinessMachineCustomFieldController@update');
    Route::delete('{id}', 'Business\BusinessMachineCustomFieldController@destroy');
    Route::resource('', 'Business\BusinessMachineCustomFieldController');
});