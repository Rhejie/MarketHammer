<?php

Route::group(['namespace' => 'API'], function() {

	Route::group(['prefix' => 'product', 'namespace' => 'Product'], function() {
	    Route::get('/keywords/{key}', 'ProductController@getKeywords');
	    Route::match(['get', 'post'], '/all', 'ProductController@getAll');
	});

	Route::group(['prefix' => 'supplier', 'namespace' => 'Supplier'], function() {
	    Route::get('/keywords/{key}', 'SupplierController@getKeywords');
	    Route::match(['get', 'post'], '/all', 'SupplierController@getAll');
	    Route::get('/category/{search}', 'SupplierController@getCategory');
	});

});


Route::group(['prefix' => 'search'], function() {
    Route::post('/meta', 'Utils\SearchController@getMetaData');
});