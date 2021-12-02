<?php

Route::group(['prefix' => 'cluster', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function() {
    Route::get('get-themes-data', 'ClusterController@getThemesDropdown');
    Route::post('get-categories-data', 'ClusterController@getCategoriesDropdown');
    Route::post('get-all-categories-data', 'ClusterController@getAllCategoriesForDropdown');
    Route::get('get-categories-data-by-id', 'ClusterController@getCategoriesDropdownById');
    Route::get('get-countries-data', 'ClusterController@getCountriesDropdown');
    Route::get('{id}', 'ClusterController@show');
    Route::put('{id}', 'ClusterController@update');
    Route::delete('{id}', 'ClusterController@destroy');
    Route::resource('', 'ClusterController');
});