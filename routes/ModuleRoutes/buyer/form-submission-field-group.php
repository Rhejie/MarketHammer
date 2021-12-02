<?php

Route::group(['prefix' => 'form-builder-field-group', 'namespace' => 'Buyer'], function() {
	Route::match(['post', 'get'], 'get-form-builder-field-groups', 'FormSubmissionGroupController@fetch')->name('form-builder-field-group.get-form-builder-field-groups');
	Route::post('build-template', 'FormSubmissionGroupController@buildTemplate')->name('form-builder-field-group.build-template');
});

Route::resource('form-builder-field-group', 'Buyer\FormSubmissionGroupController');