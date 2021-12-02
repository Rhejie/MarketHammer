<?php

/**
 * Routes for backoffice.
 * Any routes dealing with Back Office must be registered here.
 *
 * @author Ren
 */

// use App\Http\Controllers\BackOffice\BusinessListController;

Route::group(['prefix' => 'business-list', 'as' => 'business-list.'], function () {
    Route::get('/', 'BackOffice\BusinessListController@index')->name('business-list')->middleware('isAdmin');
    Route::match(['get', 'post'], '/get-business-list', 'BackOffice\BusinessListController@getBusinessList')->name('get-business-list');

    Route::get('/search-filter-data', 'BackOffice\BusinessListController@searchFilterData');
    Route::post('/get-form-initial-data', 'BackOffice\BusinessListController@getFormInitialData');
    Route::post('/get-categories', 'BackOffice\BusinessListController@getCategories');
    Route::post('/get-business', 'BackOffice\BusinessListController@getBusiness');
    Route::post('/get-user-search-history', 'BackOffice\BusinessListController@getUserSearchHistory');
    Route::post('/get-bookmarked-stores', 'BackOffice\BusinessListController@getBookmarkedStores');
    Route::get('/{id}', 'BackOffice\BusinessListController@show')->middleware('isAdmin');
    Route::post('/upload-business-banners', 'BackOffice\BusinessListController@importBusinessBanners')->name('business-list.upload-banners');
    Route::post('/upload-business-videos', 'BackOffice\BusinessListController@importBusinessVideos')->name('business-list.upload-videos');
    Route::post('/save-business-banners/{id}', 'BackOffice\BusinessListController@saveBusinessBanners');
    Route::post('/mark-bookmark', 'BackOffice\BusinessListController@markBookmark');
    Route::post('/set-banner-primary', 'BackOffice\BusinessListController@setBannerprimary');
    Route::post('/remove-banner', 'BackOffice\BusinessListController@removeBanner');
    Route::get('/get-business-nda/{id}', 'BackOffice\BusinessListController@getBusinessNda');
    Route::post('/upload-business-nda', 'BackOffice\BusinessListController@importBusinessNda')->name('business-list.upload-nda');
    Route::post('/remove-nda', 'BackOffice\BusinessListController@removeBusinessNda')->name('business-list.remove-nda');

    // franz
    Route::post('/get-plans', 'BackOffice\BusinessListController@getPlans');
    Route::post('/get-types', 'BackOffice\BusinessListController@getTypes');
    Route::post('/import-business-list', 'BackOffice\BusinessListController@importBusinessList');

    Route::post('/save-business-list-from-store-details', 'BackOffice\BusinessListController@saveFromStoreDetails');

    Route::post('/delete-business-banner', 'BackOffice\BusinessListController@deleteBusinessBanner');

    Route::post('/upload-business-files', 'BackOffice\BusinessListController@importBusinessFiles')->name('business-list.upload-files');

    // // business claims
    Route::post('/save-business-claims', 'BackOffice\BusinessListController@saveBusinessClaim');
    Route::post('/upload-business-claim-files', 'BackOffice\BusinessListController@importBusinessClaimFiles')->name('business-list.upload-claim-files');

    // resource routes must be at the last part
    Route::delete('/{id}', 'BackOffice\BusinessListController@destroy')->name('destroy');
    Route::match(['put', 'post'], '/{id}', 'BackOffice\BusinessListController@update')->name('update');
    Route::apiResource('/', 'BackOffice\BusinessListController')->only([
        'index', 'store', 'show'
    ])->middleware('isAdmin');
    Route::get('/downloadimage/{id}', 'BackOffice\BusinessListController@downloadImage');
    Route::get('/relevance/{keyword}', 'BackOffice\BusinessListController@relevance');


    // Route::post('/importBusinessFromExcel', [BusinessListController::class, 'importBusinessFromExcel']);
    // Route::post('/importBusinessKeywordFromExcel', [BusinessListController::class, 'importBusinessKeywordFromExcel']);
});
