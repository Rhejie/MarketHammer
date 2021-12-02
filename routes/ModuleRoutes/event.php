<?php

/**
 * Routes for backoffice event.
 * Any routes dealing with Back Office Events should be registered here.
 *
 * @author Ren
 */

Route::group(['prefix' => 'event'], function () {
	Route::match(['get', 'post'], '/get-events', 'BackOffice\EventController@getEvents')->name('get-events');
	Route::match(['put', 'patch', 'post'], '/{id}', 'BackOffice\EventController@update')->name('update');
	Route::delete('/{id}', 'BackOffice\EventController@destroy')->name('destroy');
	Route::resource('/', 'BackOffice\EventController');
});