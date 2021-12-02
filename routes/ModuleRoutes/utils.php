<?php

Route::group(['prefix' => 'utils'], function () {
    Route::get('/get-states/{country_id}', 'Utils\SearchController@getStates')->name('get-states');
    // Route::post('/get-states', 'Utils\SearchController@getStates')->name('get-states');
    Route::post('/get-meta-data', 'Utils\SearchController@getMetaData')->name('get-meta-data');
});
