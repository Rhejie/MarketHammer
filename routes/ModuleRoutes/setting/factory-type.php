<?php

Route::group(['prefix' => 'factory-type', 'namespace' => 'BackOffice'], function () {
    Route::match(['post', 'get'], 'get-factory-types', 'Setting\FactoryTypeController@getFactoryTypes')->name('factory-type.get-factory-types');
    Route::get('/getFactoryTypeForAddress', 'Setting\FactoryTypeController@getFactoryTypesForAddress')->name('factory-types');
});

Route::resource('factory-type', 'BackOffice\Setting\FactoryTypeController');
