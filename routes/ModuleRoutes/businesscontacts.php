<?php

Route::group(['prefix' => 'business-contact', 'namespace' => 'BackOffice'], function() {
	Route::post('export-contacts', 'BusinessContactController@exportContacts')->name('export-contacts');
	Route::match(['post', 'get'], 'get-contact-list', 'BusinessContactController@getBusinessContacts')->name('get-contact-list');
    Route::get('{id}', 'BusinessContactController@show');
    Route::put('{id}', 'BusinessContactController@update');
    Route::delete('{id}', 'BusinessContactController@destroy');
    Route::resource('', 'BusinessContactController')->middleware('isAdmin');
});