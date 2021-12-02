<?php

Route::group(['prefix' => 'address-type', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-address-types', 'Setting\AddressTypeController@getAddressTypes')->name('address-type.get-address-types');
});

Route::resource('address-type', 'BackOffice\Setting\AddressTypeController');