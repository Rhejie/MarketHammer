<?php

Route::match(['post', 'get'], '/business-sns/get-business-list', 'BackOffice\Business\BusinessSnsController@getBusinessSnsList')->name('get-business-list');
Route::resource('business-sns', 'BackOffice\Business\BusinessSnsController');
