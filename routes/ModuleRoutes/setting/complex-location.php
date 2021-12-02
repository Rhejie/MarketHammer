<?php

// Complex types routes
Route::group(['prefix' => 'complex-location', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('/get-complex', 'ComplexLocationController@getComplex')->name('complex-location.get-complex');
    Route::get('/get-complex-locations', 'ComplexLocationController@index')->name('complex-location.get-complex-locations');
});

Route::resource('complex-location', 'BackOffice\Setting\ComplexLocationController');