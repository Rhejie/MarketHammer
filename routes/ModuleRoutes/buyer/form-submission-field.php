<?php

Route::group(['prefix' => 'form-builder-field', 'namespace' => 'Buyer'], function() {
	Route::match(['post', 'get'], 'get-form-builder-fields', 'FormSubmissionFieldController@fetch')->name('form-builder-field.get-form-builder-fields');
});

Route::resource('form-builder-field', 'Buyer\FormSubmissionFieldController');