<?php

     Route::group(['prefix' => 'form-field-answer'], function () {
          Route::post('/save-answer', 'Supplier\FormFieldAnswerController@saveAnswer')->name('save-answer');
          Route::get('{id}', 'Supplier\FormFieldAnswerController@show');
          Route::put('{id}', 'Supplier\FormFieldAnswerController@update');
          Route::delete('{id}', 'Supplier\FormFieldAnswerController@destroy');
          Route::resource('', 'Supplier\FormFieldAnswerController');

     });

     Route::group(['prefix' => 'form-submission-to-supplier'], function () {
          Route::put('{id}', 'Supplier\FormSubmissionToSupplierController@update');
          Route::delete('{id}', 'Supplier\FormSubmissionToSupplierController@destroy');
          Route::resource('', 'Supplier\FormSubmissionToSupplierController');

     });