<?php

Route::group(['prefix' => 'sns', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-sns-list', 'Setting\SnsController@getSnsList')->name('get-sns-list');
});

Route::resource('sns', 'BackOffice\Setting\SnsController');