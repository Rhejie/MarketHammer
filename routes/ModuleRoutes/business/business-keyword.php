<?php

// Complex types routes
Route::group(['prefix' => 'business-keyword', 'namespace' => 'BackOffice\Business'], function () {
    Route::post('/delete-keyword-by-name', 'BusinessKeywordController@deleteBusKeyword');
    Route::get('/get-complex', 'BusinessKeywordController@getComplex')->name('business-keyword.get-complex');
    Route::get('/get-business-keywords', 'BusinessKeywordController@index')->name('business-keyword.get-business-keywords');
    Route::get('/get-business-keywords-data/{business_id}', 'BusinessKeywordController@getBusinessKeyword');
    Route::post('/add-new-keyword', 'BusinessKeywordController@addKeyword');
    Route::post('/add-selected-keyword', 'BusinessKeywordController@addSelectedKeyword');
    Route::post('/delete-keyword/{id}', 'BusinessKeywordController@deleteKeyword');
});

Route::resource('business-keyword', 'BackOffice\Business\BusinessKeywordController');
