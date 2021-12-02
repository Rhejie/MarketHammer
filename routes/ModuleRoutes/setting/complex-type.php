<?php

// Complex types routes
Route::group(['prefix' => 'complex-type', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('/get-complex', 'ComplexTypeController@getComplex')->name('complex-type.get-complex');
    Route::get('/get-complex-types', 'ComplexTypeController@index')->name('complex-type.get-complex-types');
});

Route::resource('complex-type', 'BackOffice\Setting\ComplexTypeController');