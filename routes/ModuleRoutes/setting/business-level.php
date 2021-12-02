<?php

Route::group(['prefix' => 'business-level', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-business-levels', 'Setting\BusinessLevelController@index')->name('business-level.get-business-levels');
});

Route::resource('business-level', 'BackOffice\Setting\BusinessLevelController');