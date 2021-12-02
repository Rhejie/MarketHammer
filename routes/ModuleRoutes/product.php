<?php

Route::group(['prefix' => 'product', 'namespace' => 'BackOffice'], function () {
    Route::match(['post', 'get'], 'get-product-list', 'Product\ProductController@getProducts')->name('get-product-list');
    Route::get('{id}', 'Product\ProductController@show');
    Route::put('{id}', 'Product\ProductController@update');
    Route::delete('{id}', 'Product\ProductController@destroy');
    Route::resource('', 'Product\ProductController');
});

Route::group(['prefix' => 'product-keyword', 'namespace' => 'BackOffice'], function () {
    Route::match(['post', 'get'], 'get-product-keywords', 'Product\ProductKeywordController@getProductKeywords')->name('get-product-keywords');
    Route::get('{id}', 'Product\ProductKeywordController@show');
    Route::put('{id}', 'Product\ProductKeywordController@update');
    Route::delete('{id}', 'Product\ProductKeywordController@destroy');
    Route::resource('', 'Product\ProductKeywordController');
});

Route::group(['prefix' => 'product-media', 'namespace' => 'BackOffice'], function () {
    /*Route::match(['post', 'get'], 'get-product-keywords', 'Product\ProductMediaController@getProductKeywords')->name('get-product-keywords');
    Route::get('{id}', 'Product\ProductMediaController@show');
    Route::put('{id}', 'Product\ProductMediaController@update');*/
    Route::delete('{id}', 'Product\ProductMediaController@destroy');
    Route::resource('', 'Product\ProductMediaController');
});
