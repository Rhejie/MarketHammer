<?php

Route::group(['prefix' => 'search', 'namespace' => 'Home'], function() {
    Route::post('/save-search-history', 'SearchController@saveHistory');
    Route::post('/most-searched', 'SearchController@mostSearched');
});