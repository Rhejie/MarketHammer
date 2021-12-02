<?php

Route::group(['prefix' => 'certification-type', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-certification-types', 'Setting\CertificationTypeController@getCertificationTypes')->name('certification-type.get-certification-types');
});

Route::resource('certification-type', 'BackOffice\Setting\CertificationTypeController');