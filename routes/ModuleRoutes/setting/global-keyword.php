<?php

Route::group(['prefix' => 'global-keyword', 'namespace' => 'BackOffice'], function () {
    Route::match(['post', 'get'], 'get-keyword-list', 'Setting\GlobalKeywordController@getKeywordList')->name('global-keyword.get-keyword-list');
    Route::match(['post', 'get'], 'search-keywords', 'Setting\GlobalKeywordController@searchKeywords')->name('global-keyword.search-keywords');
    Route::get('get-keywords', 'Setting\GlobalKeywordController@getKeywords');
    Route::get('get-all-keywords', 'Setting\GlobalKeywordController@getAllKeywords');
});

Route::resource('global-keyword', 'BackOffice\Setting\GlobalKeywordController');
