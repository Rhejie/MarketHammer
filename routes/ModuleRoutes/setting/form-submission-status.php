<?php


Route::group(['prefix' => 'form-status', 'namespace' => 'BackOffice\Setting'], function () {
    Route::get('get-form-status', 'FormSubmissionStatusController@index');
    //Route::match(['post', 'get'], 'get-form-status', 'FormSubmissionStatusController@index')->name('form-status.get-form-status');
    Route::post('store-form-status', 'FormSubmissionStatusController@store');
    Route::post('update-form-status/{id}', 'FormSubmissionStatusController@update');
    Route::post('delete-form-status/{id}', 'FormSubmissionStatusController@destroy');
});
