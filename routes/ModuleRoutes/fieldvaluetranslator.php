<?php

use App\Http\Controllers\BackOffice\FieldValueTranslatorController;
use App\Model\FieldValueTranslator;

Route::group(['prefix' => 'field-value-translator', 'namespace' => 'BackOffice'], function () {
    Route::get('{id}', 'FieldValueTranslatorController@show');
    Route::put('{id}', 'FieldValueTranslatorController@update');
    Route::delete('{id}', 'FieldValueTranslatorController@destroy');
    Route::resource('', 'FieldValueTranslatorController');
    Route::get('/showTrans/{table_name}', [FieldValueTranslatorController::class, 'showTrans']);
});
