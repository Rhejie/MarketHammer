<?php

use App\Http\Controllers\BackOffice\BusinessCategoryController;

Route::group(['prefix' => 'business-category', 'namespace' => 'BackOffice', 'middleware' => 'isAdmin'], function () {
    Route::match(['post', 'get'], 'get-business-categories', 'BusinessCategoryController@getBusinessCategories')->name('get-business-categories');
    Route::match(['post', 'get'], 'get-category-list', 'BusinessCategoryController@getCategories')->name('get-category-list');
    Route::post('upload-image', 'BusinessCategoryController@uploadImage')->name('category.image-upload');
    Route::get('get-industry-types-data', 'BusinessCategoryController@getIndustryTypesForDropdown');
    Route::get('/{id}', 'BusinessCategoryController@show');
    Route::put('/{id}', 'BusinessCategoryController@update');
    Route::delete('/{id}', 'BusinessCategoryController@destroy');
    Route::post('/import-category', 'BusinessCategoryController@importCategory');
    Route::post('/update-import-category', 'BusinessCategoryController@updateImportCategory');
    Route::resource('/', 'BusinessCategoryController');
    Route::get('/getCategoryTranslation/${id}', [BusinessCategoryController::class, 'getParentCategoryTranslation']);
});
