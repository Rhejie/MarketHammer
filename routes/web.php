<?php

use App\Http\Controllers\BusinessMaterialController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\Chat\TwilioChatLogController;
use App\Http\Controllers\ComplexLocationController;
use App\Http\Controllers\ComplexTypeController;
use App\Http\Controllers\UsageAreaController;
use App\Model\ComplexType;
use Illuminate\Support\Facades\Route;
use App\Models\UserType;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// code for RouteServiceProvider moved at line 77

//Route::get('/home', 'HomeController@index')->name('home');

// Home Routes
/*Route::group(['prefix' => 'home'], function () {
    require_once base_path('routes/ModuleRoutes/events.php');
    require_once base_path('routes/ModuleRoutes/search.php');
});*/

//store details enable logged out use to visit
//Route::get('/store/details/{id}', 'StoreController@details');

// Live Videos
/*Route::group(['prefix' => 'live-videos'], function () {
    Route::post('/list', 'LiveVideoController@getLiveVideos');
    Route::post('/all', 'LiveVideoController@getAllLiveVideos');
    Route::post('/delete', 'LiveVideoController@deleteStream');
    Route::resource('/', 'LiveVideoController');
});*/


require_once base_path('routes/ModuleRoutes/businesscategory.php');
// Route::get('/get-categories-for-search', 'BackOffice\CategoryController@getCategories');
// Route::get('/get-parent-categories', 'BackOffice\CategoryController@getParentCategories');

// firebase testing only
Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');

Route::post('/log-event', 'NotificationController@sendMessage');

Route::group(['prefix' => 'business-list'], function () {
    Route::post('/get-nearest-stores', 'BackOffice\BusinessListController@getNearestStores');
    Route::post('/get-featured-stores', 'BackOffice\BusinessListController@geFeaturedStores');
    Route::post('/import-business-from-excel', 'BackOffice\BusinessListController@importBusinessFromExcel');
    Route::post('/import-business-keyword-from-excel', 'BackOffice\BusinessListController@importBusinessKeywordFromExcel');
    Route::post('/customImportExcel', 'BackOffice\BusinessListController@customImportExcel');
    Route::post('/preview-excel-keyword', 'BackOffice\BusinessListController@previewExcelKeyword');
    Route::get('/eid-certificate-list/{id}', 'BackOffice\BusinessListController@eidCertificatelist');
    Route::post('/eid-attachment-delete/{fileURL}', 'BackOffice\BusinessListController@deleteFileAttachment');
    Route::post('/business-category/{busCat}', 'BackOffice\BusinessListController@checkCategory');
});

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'signin'], function () {
    Route::get('/{provider}', 'Auth\SocialAuthController@handleSocialRedirect');
    Route::get('/{provider}/callback', 'Auth\SocialAuthController@handleSocialCallback');
});

Route::group(['middleware' => ['auth', 'verified']], function () {            // Protect routes from unverified users
    Route::get('/backoffice', 'BackOfficeController@index')->name('backoffice')->middleware('isAdmin');



    // Buyer routes

    // Back Office routes

    //moved the code to here to able to redirect to logout. also to able to redirect to proper
    //pages in their respective user type page
    Route::get('/', 'BackOfficeController@redirect');

    Route::get('/buyer', [BuyerController::class, 'index']);
    Route::get('/excel', 'HomeController@excel');
    Route::get('/category-template', 'HomeController@categoryTemplate');
    Route::get('/industry-template', 'BackOffice\IndustryTypeController@importTemplate');
    //Route::get('/chat/get-token', 'Utils\ChatController@GetToken');

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/get-token', 'Utils\ChatController@GetToken');
    });

    Route::group(['prefix' => 'business-export'], function () {
        Route::get('/business-export-excel', 'BackOffice\BusinessListController@exportBusinesskeywords');
        Route::get('/business-list-export-excel', 'BackOffice\BusinessListController@exportBusinessList');
    });

    Route::group(['prefix' => 'video-call'], function () {
        Route::get('/get-token/{roomname?}', 'Utils\VideoCallController@GetToken');
        Route::get('/get-ringcentral-config/', 'Utils\VideoCallController@GetRingCentralConfig');
        Route::get('/get-participant-name/{user_id}', 'Utils\VideoCallController@getParticipantName');
    });

    Route::group(['prefix' => 'docu-sign'], function () {
        Route::get('/test', 'Utils\DocusignController@test');
        Route::get('/get-test/{id}', 'Utils\DocusignController@getenvelope');
        Route::get('/get-nda-document/{id}', 'Utils\DocusignController@getNdaDocument');
        Route::get('/get-nda-envelope-status/{id}', 'Utils\DocusignController@getNdaEnvelopeStatus');
        Route::post('/request-signature', 'Utils\DocusignController@requestDocumentSignature');
        Route::get('/get-test-data', 'Utils\DocusignController@getTestData');
    });

    // user-token route collection
    require base_path('routes/ModuleRoutes/user-token.php');

    // buyer
    require_once base_path('routes/ModuleRoutes/buyer/buyer-form-list.php');

    require_once base_path('routes/ModuleRoutes/backoffice.php');
    // require_once base_path('routes/ModuleRoutes/category.php'); // excluded from middleware to fix errors for guest users
    require_once base_path('routes/ModuleRoutes/cluster.php');
    require_once base_path('routes/ModuleRoutes/theme.php');
    require_once base_path('routes/ModuleRoutes/industrytype.php');
    require_once base_path('routes/ModuleRoutes/event.php');
    require_once base_path('routes/ModuleRoutes/company.php');
    require_once base_path('routes/ModuleRoutes/fieldvaluetranslator.php');

    require_once base_path('routes/ModuleRoutes/businesstype.php');
    require_once base_path('routes/ModuleRoutes/businessclaim.php');
    require_once base_path('routes/ModuleRoutes/businesscontacts.php');
    // business modules
    require_once base_path('routes/ModuleRoutes/business/business-address.php');
    require_once base_path('routes/ModuleRoutes/business/business-sns.php');
    require_once base_path('routes/ModuleRoutes/business/business-partner.php');
    require_once base_path('routes/ModuleRoutes/business/business-certification.php');
    require_once base_path('routes/ModuleRoutes/business/business-product.php');
    require_once base_path('routes/ModuleRoutes/business/business-machine.php');
    require_once base_path('routes/ModuleRoutes/business/business-finance.php');
    require_once base_path('routes/ModuleRoutes/business/business-qsa.php');
    require_once base_path('routes/ModuleRoutes/business/business-keyword.php');
    require_once base_path('routes/ModuleRoutes/business/business-processes.php');
    require_once base_path('routes/ModuleRoutes/business/business-esg.php');

    require_once base_path('routes/ModuleRoutes/backoffice/user.php');


    require_once base_path('routes/ModuleRoutes/product.php');

    // settings
    require_once base_path('routes/ModuleRoutes/setting/translation.php');
    require_once base_path('routes/ModuleRoutes/setting/sns.php');
    require_once base_path('routes/ModuleRoutes/setting/global-keyword.php');
    require_once base_path('routes/ModuleRoutes/setting/factory-type.php');
    require_once base_path('routes/ModuleRoutes/setting/address-type.php');
    require_once base_path('routes/ModuleRoutes/setting/certification-type.php');
    require_once base_path('routes/ModuleRoutes/setting/business-level.php');
    require_once base_path('routes/ModuleRoutes/setting/complex-type.php');
    require_once base_path('routes/ModuleRoutes/setting/processes.php');
    require_once base_path('routes/ModuleRoutes/setting/complex-location.php');
    require_once base_path('routes/ModuleRoutes/setting/form-group.php');
    require_once base_path('routes/ModuleRoutes/setting/form-submission-status.php');
    require_once base_path('routes/ModuleRoutes/setting/form-type.php');
    require_once base_path('routes/ModuleRoutes/setting/supplier-status.php');
    require_once base_path('routes/ModuleRoutes/setting/operation-condition.php');



    Route::group(['prefix' => 'system-data', 'as' => 'system-data.'], function () {
        require_once base_path('routes/ModuleRoutes/systemdata.php');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        require_once base_path('routes/ModuleRoutes/setting.php');
        Route::match(['post', 'get'], 'get-qsa-list', 'BackOffice\QsaListController@getList')->name('get-list');
    });

    Route::group(['prefix' => 'country'], function () {
        Route::put('/{id}', 'BackOffice\Setting\CountryController@update');
        Route::match(['get', 'post'], '/get-countries', 'BackOffice\Setting\CountryController@getCountries')->name('country.get-countries');
    });

    Route::group(['prefix' => 'state'], function () {
        Route::put('/{id}', 'BackOffice\Setting\StateController@update');
        Route::match(['get', 'post'], '/get-state', 'BackOffice\Setting\StateController@getCountries')->name('state.get-state');
    });

    Route::group(['prefix' => 'business-material'], function () {
        Route::post('/storeMaterial', [BusinessMaterialController::class, 'store']);
        Route::get('/getBusinessMaterials/{id}', [BusinessMaterialController::class, 'index']);
        Route::get('/getMaterials', [BusinessMaterialController::class, 'getMaterials']);
        Route::post('/deleteBusinessMaterial/{id}', [BusinessMaterialController::class, 'deleteBusinessMaterial']);
        Route::post('/updateBusinessMaterial/{id}', [BusinessMaterialController::class, 'updateBusinessMaterial']);
    });

    require_once base_path('routes/ModuleRoutes/role-permission.php');
    require_once base_path('routes/ModuleRoutes/business-user-type-permission.php');
    require_once base_path('routes/ModuleRoutes/form-field-answer.php');

    Route::group([/*'middleware' => ['role:supplier']*/], function () {
        require_once base_path('routes/ModuleRoutes/supplier/supplier.php');
    });

    Route::group(['prefix' => 'buyer', 'as' => 'buyer.'], function () {
        require_once base_path('routes/ModuleRoutes/buyer.php');
        require_once base_path('routes/ModuleRoutes/buyer/buyer-form-template.php');
        require_once base_path('routes/ModuleRoutes/buyer/form-submission-field-group.php');
        require_once base_path('routes/ModuleRoutes/buyer/form-submission-field.php');
    });





    // Home Routes
    //Route::group(['prefix' => 'home'], function () {
        // require_once base_path('routes/ModuleRoutes/events.php'); // excluded from middleware to fix errors for guest users
        //require_once base_path('routes/ModuleRoutes/user.php');
        //require_once base_path('routes/ModuleRoutes/announcement.php');
        //require_once base_path('routes/ModuleRoutes/coupon.php');
        // require_once base_path('routes/ModuleRoutes/search.php');
        //require_once base_path('routes/ModuleRoutes/review.php');

        //Route::post('/get-countries', 'HomeController@getCountries');
        //Route::get('/store-details', 'HomeController@store_details');
        //Route::get('/bookmarked-stores', 'StoreController@bookmarked_stores');
    //});

    // My Page routes
    /*Route::group(['prefix' => 'my-page'], function () {
        Route::get('/store-details', 'MyPageController@store_details');
        Route::get('/', 'MyPageController@index');
        Route::get('/search-history', 'MyPageController@search_history');
        Route::get('/my-coupon', 'MyPageController@my_coupon');
        Route::get('/event', 'MyPageController@event');
        Route::get('/event/show', 'MyPageController@show_event');
        Route::get('/announcements', 'MyPageController@announcements');
        Route::get('/announcement/{id}/show', 'MyPageController@show_announcement');
        Route::get('/help', 'MyPageController@help');
        Route::get('/qna', 'MyPageController@qna');
        Route::get('/support-chat', 'MyPageController@chat_support');

        require_once base_path('routes/ModuleRoutes/global-search.php');
    });*/

    // Store routes
    //Route::group(['prefix' => 'store', 'middleware' => 'auth'], function () {
        // Route::get('/details/{id}', 'StoreController@details');
    //});
    // Areas routes
    Route::group(['prefix' => 'area'], function () {
        Route::post('/addNewArea', [UsageAreaController::class, 'store']);
        Route::get('/getAreas', [UsageAreaController::class, 'index']);
        Route::post('/deleteArea/{id}', [UsageAreaController::class, 'destroy']);
        Route::post('/updateArea/{id}', [UsageAreaController::class, 'update']);
    });

    Route::group(['prefix' => 'twilio-log'], function() {
        Route::get('/', [TwilioChatLogController::class, 'findAll']);
        Route::post('/', [TwilioChatLogController::class, 'store']);
        Route::delete('/', [TwilioChatLogController::class, 'destroy']);
    });
});

// Registration Route Collection
require_once base_path('routes/ModuleRoutes/registration.php');

// Utilitie routes collection
require_once base_path('routes/ModuleRoutes/utils.php');

Route::prefix('web-auth')->group(function() {
    Route::get('/redirect', "Auth\WebAuthController@redirectAuth")->name('redirect.auth.session');
    Route::get('/revoke', "Auth\WebAuthController@revokeAuth")->name('revoke.auth.session')->middleware(['auth']);
});

Route::get('/update-date-established', [\App\Http\Controllers\TestController::class, 'updateDateEstablished']);
