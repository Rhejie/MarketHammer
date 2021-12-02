<?php

use App\Http\Controllers\BackOffice\Business\BussinessMaterialController;

Route::group(['prefix' => 'bussiness-material'], function () {
    Route::get('/getBusinessMaterials', [BusinessMaterialController::class, 'index']);
    Route::post('/storeBusinessMaterial', [BussinessMaterialController::class, 'store']);
});
