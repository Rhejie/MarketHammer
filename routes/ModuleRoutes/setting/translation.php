<?php

Route::group(['prefix' => 'translation', 'namespace' => 'BackOffice'], function() {
	Route::match(['post', 'get'], 'get-translations', 'Setting\TranslationController@getTranslations')->name('translation.get-translations');
	Route::get('sync-translations', 'Setting\TranslationController@syncTranslations')->name('translation.sync-translations');
});

Route::resource('translation', 'BackOffice\Setting\TranslationController');