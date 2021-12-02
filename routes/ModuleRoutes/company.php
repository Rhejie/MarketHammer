<?php

Route::group(['prefix' => 'company', 'namespace' => 'BackOffice'], function() {
     Route::resource('', 'CompanyController');
});