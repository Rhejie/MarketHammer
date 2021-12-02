<?php

Route::get('buyer/form/list', 'Buyer\FormListController@index');

Route::group(['prefix' => 'areas'], function () {
    Route::post('/create-form-data', 'Buyer\FormListController@createForm')->name('buyer-form-list.create-form');
    Route::get('/get-form-list', 'Buyer\FormListController@getFormList')->name('buyer-form-list.get-form-list');
    Route::post('/delete-form-list/{id}', 'Buyer\FormListController@deleteForm');
    Route::post('/update-form-data/{id}', 'Buyer\FormListController@updateFormData');
    Route::get('/get-select-submissiom', 'Buyer\FormListController@getSelect');
    Route::post('/add-form-builder-template/{id}', 'Buyer\FormListController@addFormBuilderTemplate');
    Route::get('/check-template/{id}', 'Buyer\FormListController@ckeckTemplate');
    Route::get('/get-form-fields', 'Buyer\FormListController@getFormFields');
    Route::get('/get-form-gorups', 'Buyer\FormListController@getFormGroups');
    Route::post('/add-form-bulder-group', 'Buyer\FormListController@addFormBulderGroup');
    Route::post('/add-form-builder-field', 'Buyer\FormListController@addFormField');
    Route::post('/send-to-favorite-suppliers', 'Buyer\FormListController@sendToFavoriteSuppliers');
    Route::post('/update-form-template', 'Buyer\FormListController@updateFormTemplate');
    Route::get('/get-selected-template-ui/{id}', 'Buyer\FormListController@getSelectedTemplate');
    Route::get('/get-form-id-generated', 'Buyer\FormListController@getFormIDGenerated');
    Route::get('/get-suppliers', 'Buyer\FormListController@getSuppliers');
    Route::post('/send-to-suppliers-manually', 'Buyer\FormListController@sendToSupplierManually');
    Route::get('/answer-submision-form/{id}', 'Buyer\FormListController@answerSubmussionForm');
    Route::post('/select-as-answer/{id}', 'Buyer\FormListController@selectAsAnswer');
    Route::post('/reject-as-answer/{id}', 'Buyer\FormListController@rejectAsAnswer');
    Route::post('/update-form-submission-status/{id}', 'Buyer\FormListController@updateFormSubmissionStatus');
    Route::get('/check-send-to-supplier/{id}',  'Buyer\FormListController@checkSendToSupplier');
    Route::get('/get-response-answer-supplier', 'Buyer\FormListController@getResponseAnswerSupplier');
    Route::get('/get-value-form-table', 'Buyer\FormListController@getValueFromTable');
    Route::get('/get-option-form-source-table', 'Buyer\FormListController@getOptionFormSourceTable');
    Route::get('/get-export-form-submission/{id}', 'Buyer\FormListController@export');
});

// Route::post('/create-form-data', 'Buyer\FormListController@createForm')->name('buyer-form-list.create-form');
