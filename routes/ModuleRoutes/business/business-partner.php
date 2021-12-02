<?php

Route::group(['prefix' => 'business-partner', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-partner-list', 'BusinessPartnerController@getBusinessPartners')->name('get-partner-list');
    Route::get('{id}', 'BusinessPartnerController@show');
    Route::put('{id}', 'BusinessPartnerController@update');
    Route::delete('{id}', 'BusinessPartnerController@destroy');
    Route::resource('', 'BusinessPartnerController');
});