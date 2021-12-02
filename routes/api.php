<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$apiRoutes = [
    'suppliers'                 	=> 'API\Supplier\SupplierController',
    'products'                       => 'API\Product\ProductController',
    'users'                       => 'API\User\UserController',
];

foreach ($apiRoutes as $model => $className) {

    Route::group([
        'prefix' => "/$model",
        'middleware' => ['auth:api'],
    ], function () use ($model, $className) {
            /**
             * Retrieves all but NOT paginated
             */
            Route::get('/all', "$className@getAll")->name("api.$model.getAll");

            /**
             * Retrieves all but paginated
             */
            Route::get('/paginate', "$className@paginate")->name("api.$model.paginate");

            /**
             * Use this to either create or update a resource
             * When `id` is present, resource will be update
             */
            Route::post('/create', "$className@store")->name("api.$model.create");

            /**
             * Updates a resource
             */
            Route::post('/update', "$className@update")->name("api.$model.update");
            /**
             * Add the specific routes for models when necessary
             */
            switch ($model) {
                case 'suppliers':
                    Route::match(['get', 'post'], '/{id}/products', "$className@getProducts")->name("api.$model.getProducts");
                    Route::get('/{id}/certifications', "$className@getCertifications")->name("api.$model.getCertifications");
                    Route::get('/{id}/machines', "$className@getMachines")->name("api.$model.getMachines");
                    Route::get('/{id}/media', "$className@getMedia")->name("api.$model.getMedia");
                    Route::get('/{id}/addresses', "$className@getAddresses")->name("api.$model.getAddresses");
                    Route::get('/{id}/contacts', "$className@getContacts")->name("api.$model.getContacts");
                    Route::post('/follow', "$className@follow")->name("api.$model.follow");
                    break;

                case 'products':
                    break;

                case 'users':
                    Route::post('/follow', "$className@follow")->name("api.$model.follow");
                    break;

                default:
                    # code...
                    break;
            }
            Route::match(['get', 'post'], '/{id}', "$className@get")->name("api.$model.get");
            //Route::get('/{id}', "$className@get")->name("api.$model.get");
            Route::delete('/{id}', "$className@destroy")->name("api.$model.destroy");
        }
    );
}


Route::post('/login', 'API\AuthenticationController@login');

// Protected resources
Route::middleware(['auth:api'])->group(function () {
	Route::match(['get', 'post'], '/logout', 'API\AuthenticationController@logout');
	Route::get('/test-user', 'API\AuthenticationController@testUser');

    require_once base_path('routes/ModuleRoutes/audit_trail.php');


});

Route::group(['namespace' => 'BackOffice\Setting'], function() {
    Route::match(['get', 'post'], '/country/get-all-countries', 'CountryController@getAllCountries')->name('country.get-all-countries');
});

Route::group(['prefix' => 'public'], function() {
    require_once base_path('routes/api/public.php');
});

// Route resource for API registration
require_once base_path('routes/api/registration.php');

Route::get('/test', 'TestController@apiTest');
