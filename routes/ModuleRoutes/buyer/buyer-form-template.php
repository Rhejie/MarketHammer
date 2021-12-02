<?php

Route::group(['prefix' => 'buyer-form-template', 'namespace' => 'Buyer'], function() {
	Route::match(['post', 'get'], 'get-buyer-form-templates', 'BuyerFormTemplateController@fetch')->name('buyer-form-template.get-buyer-form-templates');
	Route::post('build-template', 'BuyerFormTemplateController@buildTemplate')->name('buyer-form-template.build-template');
});

Route::resource('buyer-form-template', 'Buyer\BuyerFormTemplateController');