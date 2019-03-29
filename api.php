l<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/form', 'PaymentController@redirect');
Route::post('/getdata', 'PaymentController@store');
// Route::post('/after_pay', 'PaymentController@back');
Route::match(['get','post'],'/after_pay','PaymentController@back');
Route::post('/success_pay', 'PaymentController@success_pay');

Route::group([
    'middleware' => ['api', 'cors','throttle:60,1',
    'bindings'],
    'prefix' => '',
], function ($router) {

	// get online product
	Route::get('/onlineGet', 'LoginApiController@onlineGet');

	// get official store
	Route::get('/officailStore', 'LoginApiController@officailStore');

	// get populare store
	Route::get('/popular', 'LoginApiController@popular');

	// get collection store
	Route::get('/collection', 'LoginApiController@collection');

	// get toabao collection
	Route::get('/toabaoCollection', 'LoginApiController@toabaoCollection');

	// get category
	Route::get('/category', 'ApiController@category');

	// get home category
	Route::get('/categoryhome', 'ApiController@categoryHome');

	// get home category
	Route::get('/category-icon', 'ApiController@categoryIcon');

	// get parent category
	Route::get('/parentCategory/{id}', 'ApiController@parentCategory');

	// get brand
	Route::get('/brand', 'ApiController@brand');

	/// get all category
	Route::get('/allCategory', 'ApiController@allCategory');

	// get cart
	Route::get('/getMyCart/{u_id}', 'LoginApiController@getMyCart');

	
	Route::get('/getMyFavorite/{u_id}', 'LoginApiController@getMyFavorite');

	// list product
	Route::get('/product-detail/{id}/{user_id?}', 'LoginApiController@ProductDetail');
	Route::get('/listProduct/{id}', 'LoginApiController@listProduct');

	Route::get('/listAllProduct', 'LoginApiController@listAllProduct');

	Route::get('/getPolicies', 'ApiController@getPolicies');
	
	Route::get('/getHelp', 'ApiController@getHelp');

	// registation user

	Route::post('/registation', 'ApiController@registation');

	// login
	Route::post('/login', 'LoginApiController@login');

	// new feed
	Route::get('/listFeed', 'LoginApiController@feed');

	// add cart

	Route::post('/addCart', 'ApiController@addCart');

	// add order

	Route::get('/orderNow/{id}', 'ApiController@OrderNow');

	// post order

	Route::post('/postOrder', 'ApiController@postOrder');

	// get my order

	Route::get('/listMyOrder/{mail}', 'LoginApiController@listMyOrder');


	Route::get('/listAdvanceSearch/{search}', 'LoginApiController@listAdvanceSearch');


	Route::get('/getUnit', 'ApiController@getUnit');

	Route::get('/getVariant', 'ApiController@getVariant');

	Route::get('/getSuppliers', 'ApiController@getSuppliers');

	Route::get('/getBrand', 'ApiController@getBrand');
	
	Route::get('/getDiscount', 'ApiController@getDiscount');

	Route::get('/getProvince', 'ApiController@getProvince');

	Route::get('/getDistrit', 'ApiController@getDistrit');

	Route::get('/getCommune', 'ApiController@getCommune');


	// get vendor
	Route::get('/getVendor/{id}', 'LoginApiController@getVendor');

	Route::post('/postVendor', 'LoginApiController@postStore');
	
	Route::post('/putVendor', 'LoginApiController@putVendor');

	Route::post('/postProducts', 'LoginApiController@postProducts');

	Route::post('/updateProducts', 'LoginApiController@updateProducts');

	Route::get('/listStoreProduct/{uid}', 'ApiController@listStoreProduct');

	Route::get('/removeProduct/{id}', 'ApiController@removeProduct');

	Route::get('/listVendor', 'LoginApiController@listVendor');
	Route::get('/product/{id}', 'ApiController@show');
    Route::get('/help', 'LoginApiController@userHelp');
    Route::group(['middleware' => 'web'], function () {
        Route::get('login/facebook', 'LoginApiController@redirectToProvider');
        Route::get('login/facebook/callback', 'LoginApiController@handleProviderCallback');
        Route::get('login/google', 'LoginApiController@redirectToGoogle');
        Route::get('login/google/callback', 'LoginApiController@handleGoogleCallback');
    });
});