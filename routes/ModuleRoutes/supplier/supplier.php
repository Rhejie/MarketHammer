<?php

Route::group(['prefix' => 'supplier', 'namespace' => 'Supplier'], function() {
	Route::get('certification', 'SupplierController@certification')->name('certification');
	Route::get('contact', 'SupplierController@contact')->name('contact');
	Route::get('machine', 'SupplierController@machine')->name('machine');
	Route::get('product', 'SupplierController@product')->name('product');
	Route::get('message', 'SupplierController@message')->name('message');
	Route::get('permission', 'SupplierController@permission')->name('permission');
	Route::get('rfq', 'SupplierController@rfq')->name('rfq');
    Route::resource('', 'SupplierController');

    Route::group(['prefix' => 'rfq-form'], function () {
		Route::match(['post', 'get'], 'get-list', 'SupplierRfqFormController@getRfq')->name('get-list');
		Route::post('get-form-details', 'SupplierRfqFormController@getFormDetails')->name('get-form-details');
		Route::post('get-fields', 'SupplierRfqFormController@getFields')->name('get-fields');

	});



    Route::group(['prefix' => 'business-follower'], function () {
    	Route::match(['post', 'get'], 'get-list', 'BusinessFollowerController@getList')->name('get-list');
    	Route::match(['post'], 'follow', 'BusinessFollowerController@follow')->name('follow');
	    Route::get('{id}', 'BusinessFollowerController@show');
	    Route::put('{id}', 'BusinessFollowerController@update');
	    Route::delete('{id}', 'BusinessFollowerController@destroy');
	    Route::resource('', 'BusinessFollowerController');

	});

	Route::group(['prefix' => 'user-follower'], function () {
    	Route::match(['post', 'get'], 'get-list', 'UserFollowerController@getList')->name('get-list');
    	Route::match(['post'], 'follow', 'UserFollowerController@follow')->name('follow');
	    Route::get('{id}', 'UserFollowerController@show');
	    Route::put('{id}', 'UserFollowerController@update');
	    Route::delete('{id}', 'UserFollowerController@destroy');
	    Route::resource('', 'UserFollowerController');

	});
});
