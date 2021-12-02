<?php

Route::group(['prefix' => 'form-field-group', 'namespace' => 'BackOffice\Setting'], function() {
	Route::match(['post', 'get'], 'get-form-field-groups', 'FormFieldGroupController@getFormFieldGroups')->name('form-field-group.get-form-field-groups');
});

Route::group(['prefix' => 'form-field', 'namespace' => 'BackOffice\Setting'], function() {
	Route::match(['post', 'get'], 'get-form-fields', 'FormFieldController@getFormFieldGroups')->name('form-field.get-form-fields');
	Route::get('fetch-component-service-data', 'FormFieldController@fetchComponentServiceData')->name('form-field.fetch-component-service-data');

	Route::get('get-field-type-list', 'FormFieldController@getFieldTypeList')->name('form-field.get-field-type-list');
	Route::get('get-option-reference-list', 'FormFieldController@getOptionReferences')->name('form-field.get-option-reference-list');
	Route::get('get-fields-list/{name}', 'FormFieldController@getFields')->name('form-field.get-fields-list');
});

/**
 * Resource routes for form field groups and form fields
 */
Route::resource('form-field', 'BackOffice\Setting\FormFieldController');
Route::resource('form-field-group', 'BackOffice\Setting\FormFieldGroupController');