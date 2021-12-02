<?php
Route::group(['prefix' => 'business-finance'], function () {
	Route::match(['post', 'get'], '/get-business-finances', 'BackOffice\Business\BusinessFinanceController@getBusinessFinances')->name('business-finance.get-business-finances');
});

Route::resource('business-finance', 'BackOffice\Business\BusinessFinanceController');
