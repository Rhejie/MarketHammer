<?php

Route::group(['prefix' => 'material-type', 'as' => 'material-type.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-material-type-list', 'MaterialTypeController@getMaterialTypes')->name('get-material-type-list');
    Route::get('{id}', 'MaterialTypeController@show');
    Route::put('{id}', 'MaterialTypeController@update');
    Route::delete('{id}', 'MaterialTypeController@destroy');
    Route::resource('', 'MaterialTypeController');
});

Route::group(['prefix' => 'material', 'as' => 'material.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-material-list', 'MaterialController@getMaterials')->name('get-material-list');
    Route::get('{id}', 'MaterialController@show');
    Route::put('{id}', 'MaterialController@update');
    Route::delete('{id}', 'MaterialController@destroy');
    Route::resource('', 'MaterialController');
});

Route::group(['prefix' => 'certification', 'as' => 'certification.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'CertificationController@show');
    Route::put('{id}', 'CertificationController@update');
    Route::delete('{id}', 'CertificationController@destroy');
    Route::resource('', 'CertificationController');
});


Route::group(['prefix' => 'certification-holder', 'as' => 'certification-holder.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'CertificationHolderController@show');
    Route::put('{id}', 'CertificationHolderController@update');
    Route::delete('{id}', 'CertificationHolderController@destroy');
    Route::resource('', 'CertificationHolderController');
});


Route::group(['prefix' => 'hazardous-substance', 'as' => 'hazardous-substance.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'HazardousSubstanceController@show');
    Route::put('{id}', 'HazardousSubstanceController@update');
    Route::delete('{id}', 'HazardousSubstanceController@destroy');
    Route::resource('', 'HazardousSubstanceController');
});

Route::group(['prefix' => 'employee-count', 'as' => 'employee-count.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'EmployeeCountController@show');
    Route::put('{id}', 'EmployeeCountController@update');
    Route::delete('{id}', 'EmployeeCountController@destroy');
    Route::resource('', 'EmployeeCountController');
});

Route::group(['prefix' => 'unit-measure', 'as' => 'unit-measure.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'UnitMeasureController@show');
    Route::put('{id}', 'UnitMeasureController@update');
    Route::delete('{id}', 'UnitMeasureController@destroy');
    Route::resource('', 'UnitMeasureController');
});

Route::group(['prefix' => 'machine-manufacturer', 'as' => 'machine-manufacturer.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'MachineManufacturerController@show');
    Route::put('{id}', 'MachineManufacturerController@update');
    Route::delete('{id}', 'MachineManufacturerController@destroy');
    Route::resource('', 'MachineManufacturerController');
});

Route::group(['prefix' => 'machine-process-type', 'as' => 'machine-process-type.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'MachineProcessTypeController@show');
    Route::put('{id}', 'MachineProcessTypeController@update');
    Route::delete('{id}', 'MachineProcessTypeController@destroy');
    Route::resource('', 'MachineProcessTypeController');
});

Route::group(['prefix' => 'machine-type', 'as' => 'machine-type.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::get('{id}', 'MachineTypeController@show');
    Route::put('{id}', 'MachineTypeController@update');
    Route::delete('{id}', 'MachineTypeController@destroy');
    Route::resource('', 'MachineTypeController');
});

Route::group(['prefix' => 'qsa-criteria', 'as' => 'qsa-criteria.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-list', 'QsaCriteriaController@getCriteria')->name('get-list');
    Route::get('{id}', 'QsaCriteriaController@show');
    Route::put('{id}', 'QsaCriteriaController@update');
    Route::delete('{id}', 'QsaCriteriaController@destroy');
    Route::resource('', 'QsaCriteriaController');
});

Route::group(['prefix' => 'qsa-type', 'as' => 'qsa-type.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-list', 'QsaTypeController@getType')->name('get-list');
    Route::get('{id}', 'QsaTypeController@show');
    Route::put('{id}', 'QsaTypeController@update');
    Route::delete('{id}', 'QsaTypeController@destroy');
    Route::resource('', 'QsaTypeController');
});

Route::group(['prefix' => 'contact-role', 'as' => 'contact-role.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-list', 'Setting\ContactRoleController@getList')->name('get-list');
    Route::get('{id}', 'Setting\ContactRoleController@show');
    Route::put('{id}', 'Setting\ContactRoleController@update');
    Route::delete('{id}', 'Setting\ContactRoleController@destroy');
    Route::resource('', 'Setting\ContactRoleController');
});
