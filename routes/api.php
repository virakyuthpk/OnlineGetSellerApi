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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/




/* -------- API Version 2.0 -------- */


Route::group(['prefix' => 'v2.0'], function(){

	// brand
	Route::get('brands', 'Api\BrandController@index');

	// discount
	Route::get('discounts', 'Api\DiscountController@index');

	// Unit 
	Route::get('units', 'Api\UnitController@index');

	// varient 
	Route::get('varients', 'Api\VariantController@index');

	// supplier 
	Route::get('suppliers', 'Api\SupplierController@index');
	Route::get('supplier/{id}', 'Api\SupplierController@show');

	// category 
	Route::get('parent-categories', 'Api\CategoryController@parentCategory'); 
	Route::get('categories/{parent?}', 'Api\CategoryController@category'); 
	Route::get('sub-categories/{parent_id?}/{cate_id?}', 'Api\CategoryController@subCategory'); 

	// product
	Route::get('products/{skip?}', 'Api\ProductController@index');
	Route::get('product/{id}', 'Api\ProductController@show');
	Route::post('product/{id?}', 'Api\ProductController@store');
	
	// user
	Route::post('login', 'Api\UserController@login');
	Route::post('register', 'Api\UserController@register');

});


/* -------- END API Version 2.0 -------- */




// testing for ournsarath
Route::post('callback-v2', 'PaymentController@oursarathCallback');

Route::get('/form', 'PaymentController@redirect');


Route::post('/getdata', 'PaymentController@store');
// Route::post('/after_pay', 'PaymentController@back');
Route::match(['get','post'],'/after_pay','PaymentController@back');
Route::post('/success_pay', 'PaymentController@success_pay');
/*-----------------------EDIT USER-------------------------*/ 
Route::post('/editUser','LoginApiController@editUser');
// review and comment
Route::post('/review-product','LoginApiController@reviewProduct'); 
Route::get('/review-product/{id}','LoginApiController@listreview');
Route::get('/countreview/{id}','LoginApiController@countreview');
Route::match(['get','post'],'/app-payment-return','PaymentController@appreturnpayment');

Route::group([
    'middleware' => ['api', 'cors','throttle:60,1',
    'bindings'],
    'prefix' => '',
], function ($router) {// get online product

        
        Route::get('/list-order/{skip?}', 'HomeController@listorder');
        Route::get('/search-order', 'HomeController@searchorder');
        
        Route::post('/review-product','LoginApiController@reviewProduct'); 
    /*new api*/
    	Route::get('/home/{skip?}', 'HomeController@index');
    	Route::get('/product/{id}/{user_id?}', 'HomeController@ProductDetail');
    	Route::get('/search/{skip?}', 'SearchController@search');
    	Route::get('/productshop/{shop_id}/{skip?}', 'HomeController@productListShop');
        Route::post('/addCart', 'HomeController@addCart');
    	Route::get('/removefavorite/{product_id}/{user_id?}', 'HomeController@removeFavorite');
        Route::get('/listFeed/{skip?}', 'HomeController@feed');
    	Route::get('/getMyFavorite/{user_id}', 'HomeController@getMyFavorite');
    	Route::get('/productshop/{shop_id}/{skip?}', 'HomeController@productshop');
    	Route::get('/mycard/{user_id}', 'HomeController@getMyCart');
    	Route::get('/removecard/{product_id}/{user_id?}', 'HomeController@removecard');
    	Route::get('/categories', 'HomeController@category');
	    Route::get('/parentcategories/{category_id}/{skip?}', 'HomeController@parentCategory');
	     Route::get('/productcategory/{id}/{short}/{skip?}', 'HomeController@ProductCategory');
	    Route::get('/popularproduct/{id}/{skip?}','HomeController@popularproduct');
	    Route::get('/countfavorite/{user_id}','HomeController@countfavorite');
	    Route::get('/countorder/{user_id}','HomeController@countorder');
	    Route::get('/feeddetail/{id}','HomeController@feeddetail');
	    Route::get('/productshop/{id}/{short}/{skip?}', 'HomeController@productshop');
	   Route::get('/listMyOrder/{mail}', 'HomeController@listMyOrder');
	   Route::post('/postOrder', 'HomeController@postOrder');
	   
	   Route::get('/orderNow/{id}', 'HomeController@OrderNow');
        Route::post('/changePasswordApp','HomeController@changePassword')->name('changePasswordApp');
        Route::get('/ListProductShorts/{id}/{short}/{skip?}', 'HomeController@ListProductShort');
         Route::post('/sociallogin', 'HomeController@sociallogin');
	   //Route::get('/testdata',['as'=> 'testdata', 'uses'=> 'HomeController@datatest']);
    //Route::get('/appreturnpayment',['as'=> 'appreturnpayment', 'uses'=>'HomeController@appreturnpayment']);
   
	    
    /*	end new*/
    
    /*----------------------- END -------------------------*/
	Route::get('/onlineGet', 'ApiController@onlineGet');
    Route::get('/slide', 'LoginApiController@slide');
    Route::get('/advertise', 'LoginApiController@advertise');
	// get official store
	Route::get('/officailStore', 'ApiController@officailStore');

	// get populare store
	Route::get('/popular', 'ApiController@popular');

	// get collection store
	Route::get('/collection', 'LoginApiController@collection');

	// get toabao collection
	Route::get('/toabaoCollection', 'ApiController@toabaoCollection');

	// get category
	Route::get('/category', 'LoginApiController@category');

	// get home category
	Route::get('/categoryhome', 'LoginApiController@categoryHome');

	// get home category
	Route::get('/category-icon', 'LoginApiController@categoryIcon');

	// get parent category
	Route::get('/parentCategory/{id}/{skip?}', 'LoginApiController@parentCategory');

	// get brand
	Route::get('/brand', 'ApiController@brand');

	/// get all category
	Route::get('/allCategory', 'LoginApiController@allCategory');

	// get cart
/*	Route::get('/getMyCart/{u_id}', 'ApiController@getMyCart');*/

	
/*	Route::get('/getMyFavorite/{u_id}', 'ApiController@getMyFavorite');*/

	// list product
	Route::get('/product-detail/{id}/{user_id?}', 'LoginApiController@ProductDetail');
	Route::get('/listProduct/{id}', 'ApiController@listProduct');

	Route::get('/listAllProduct/{skip?}', 'LoginApiController@listAllProduct');

	Route::get('/getPolicies', 'ApiController@getPolicies');
	
	Route::get('/getHelp', 'ApiController@getHelp');

	// registation user

	Route::post('/registation', 'LoginApiController@registation');

	// login
	Route::post('/login', 'LoginApiController@login');

	// new feed
/*	Route::get('/listFeed', 'LoginApiController@feed');*/

	// add cart

	/*Route::post('/addCart', 'ApiController@addCart');*/

	// add order

	
	// post order

	// get my order


	Route::get('/listAdvanceSearch/{search}/{skip?}', 'LoginApiController@listAdvanceSearch');


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
    
    
    /*internship*/
    Route::get('/online-slide', 'FrontendApiController@slide');
    Route::get('/online-categories', 'FrontendApiController@category');
    Route::get('/online-parent-categories/{id}/{skip?}', 'FrontendApiController@parentCategory');
    Route::get('/online-child-categories/{id}/{skip?}', 'FrontendApiController@childCategory');
    Route::get('/online-products/{skip?}', 'FrontendApiController@listAllProduct');
    Route::get('/online-product-detail/{id}', 'FrontendApiController@ProductDetail');
    Route::post('/online-add-card', 'FrontendApiController@addCart');
    Route::post('/online-login', 'FrontendApiController@login');
    Route::post('/online-register', 'FrontendApiController@register');
    Route::get('/online-product-arrived/{skip?}', 'FrontendApiController@newarrived');
    Route::get('/online-page/{id}', 'FrontendApiController@page');
    Route::get('/online-bestoffer/{skip?}', 'FrontendApiController@Promotion');
    Route::get('/ProductCategory/{id}/{short}/{skip?}', 'FrontendApiController@ProductCategory');
    Route::get('/ListProductShort/{short}/{skip?}', 'FrontendApiController@ListProductShort');
    Route::get('/onlinesearch/{skip?}', 'FrontendApiController@search');
    Route::post('/changePassword','FrontendApiController@changePassword')->name('changePassword');
    Route::get('/onlin-removefavorite/{shop_id}/{skip?}', 'FrontendApiController@removeFavorite');
    Route::get('/online-getMyFavorite/{user_id}', 'FrontendApiController@getMyFavorite');
    Route::get('/online-count-card/{user_id}', 'FrontendApiController@countcard');
    Route::get('/onlin-removefavorite-all/{product_id}/{user_id}', 'FrontendApiController@removeFavoritemulti');
    Route::get('/onlin-removecard-all/{product_id}/{user_id?}', 'FrontendApiController@removeCardmulti');
    Route::get('/online-total-price/{user_id}', 'FrontendApiController@totalprice');
    Route::post('online-verify-email', ['as' => 'online-verify-email', 'uses' => 'FrontendApiController@verifyEmail']);
    Route::post('resetNewPass', ['as' => 'resetNewPass', 'uses' => 'FrontendApiController@resetNewPass']);
    /*End intership*/
    
    Route::group(['middleware' => 'web'], function () {
        Route::get('login/facebook', 'LoginApiController@redirectToProvider');
        Route::get('login/facebook/callback', 'LoginApiController@handleProviderCallback');
        Route::get('login/google', 'LoginApiController@redirectToGoogle');
        Route::get('login/google/callback', 'LoginApiController@handleGoogleCallback');
    });
});

/*online user v3*/

Route::post('v3/login', 'Api\User\UserController@login');
Route::post('v3/register', 'API\UserController@register');
Route::post('v3/user-login', 'API\UserController@userlogin');

/*user login*/

Route::post('v3/user-login', 'API\UserController@userlogin');

Route::group([
    'middleware' => 'auth:api',
    'prefix'    => 'v3',
    'namespace' => '\Api\User'
], function(){ 
	Route::get('slide', 'SlideController@index');
	Route::get('category', 'CategoryController@index');
	Route::get('sub-category/{category_id?}', 'SubcategoryController@index');

	/*product*/
	Route::get('product/{skip?}', 'ProductController@index');
   	Route::get('search/{skip?}', 'ProductController@search');
   	Route::get('product-detail/{product_id}', 'ProductController@detail');
   	Route::get('product-category/{sub_category?}/{skip?}', 'ProductController@productcategory');
   	/*change password*/
   	Route::post('change-password', 'UserController@changePassword');

  	/*change profile*/
  	Route::post('change-profile', 'UserController@changeProfile');

  	Route::get('vendor', 'VendorController@index');
  	Route::get('vendor-detail/{vendor_id?}/{skip?}', 'VendorController@detail');

  	/*product popular*/
  	Route::get('popular', 'ProductController@popular');

  	Route::get('collection', 'AdvertiseController@index');
});

/*saller*/

Route::post('v4/login', 'Api\Saller\UserController@login');
Route::get('v4/product/{user_id}/{skip?}', 'Api\Saller\ProductController@index');
Route::get('v4/product-pending/{user_id}/{skip?}', 'Api\Saller\ProductController@pendding');
Route::get('v4/product-shipping/{user_id}/{skip?}', 'Api\Saller\ProductController@shipping');
Route::get('v4/product-delivery/{user_id}/{skip?}', 'Api\Saller\ProductController@delivery');
Route::get('v4/product-cancel/{user_id}/{skip?}', 'Api\Saller\ProductController@cancel');
Route::get('v4/order-report/{user_id}', 'Api\Saller\ProductController@orderreport');
Route::get('v4/shop-detail/{user_id}', 'Api\Saller\ShopController@index');
Route::get('v4/about', 'Api\Saller\PageController@about');
Route::get('v4/term', 'Api\Saller\PageController@term');

/*saller profile*/
Route::get('v4/profile/{user_id?}', 'Api\Saller\UserController@profile');
Route::get('v4/change-profile/{user_id?}', 'Api\Saller\UserController@changeProfile');