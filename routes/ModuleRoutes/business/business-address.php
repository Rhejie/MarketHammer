<?php

Route::match(['post', 'get'], '/business-address/get-business-addresses', 'BackOffice\Business\BusinessAddressController@getBusinessAddresses')->name('get-business-addresses');
Route::resource('business-address', 'BackOffice\Business\BusinessAddressController');
