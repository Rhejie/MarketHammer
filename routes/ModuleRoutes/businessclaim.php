<?php

/**
 * Routes for backoffice event.
 * Any routes dealing with Back Office Events should be registered here.
 *
 * @author Ren
 */

Route::group(['prefix' => 'business-claims'], function () {
	// Route::match(['get', 'post'], '/get-events', 'BackOffice\BusinessClaimsController@getEvents')->name('get-events');
	// Route::match(['put', 'patch', 'post'], '/{id}', 'BackOffice\BusinessClaimsController@update')->name('update');
	// Route::delete('/{id}', 'BackOffice\BusinessClaimsController@destroy')->name('destroy');
	Route::resource('/', 'BackOffice\BusinessClaimsController');
});