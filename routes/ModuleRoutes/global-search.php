<?php

Route::group(['prefix' => 'global-search', 'namespace' => 'Home'], function() {
    Route::post('/', 'GlobalSearchController@store');
    Route::get('/', 'GlobalSearchController@searchBusiness');
});