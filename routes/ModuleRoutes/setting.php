<?php

// Index page for setting
Route::get('/', 'BackOffice\Setting\SettingController@index')->name('index')->middleware('isAdmin');

Route::group(['prefix' => 'industry-type', 'as' => 'industry-type.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::resource('', 'IndustryTypeController');
});

Route::group(['prefix' => 'business-category', 'as' => 'business-category.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::resource('/', 'BusinessCategoryController');
});

Route::group(['prefix' => 'product-category', 'as' => 'product-category.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-category-list', 'ProductCategoriesController@getCategories')->name('get-category-list');
    Route::get('{id}', 'ProductCategoriesController@show');
    Route::put('{id}', 'ProductCategoriesController@update');
    Route::delete('{id}', 'ProductCategoriesController@destroy');
    Route::resource('', 'ProductCategoriesController');
});

Route::group(['prefix' => 'qsa-list', 'as' => 'qsa-list.', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-list', 'QsaListController@getList')->name('get-list');
    Route::get('{id}', 'QsaListController@show');
    Route::put('{id}', 'QsaListController@update');
    Route::delete('{id}', 'QsaListController@destroy');
    Route::resource('', 'QsaListController');
});
