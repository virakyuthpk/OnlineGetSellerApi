<?php

use Illuminate\Http\Request;
// use Symfony\Component\Routing\Annotation\Route;


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
	Route::get('products/{user_id}/{skip?}', 'Api\ProductController@index');
	Route::get('product/{id}', 'Api\ProductController@show');
// 	Route::post('product/{id?}', 'Api\ProductController@store');
	Route::post('product/{id?}', 'Api\ProductController@newStore');
	Route::get('delete-product/{id?}', 'Api\ProductController@delete');
	// user
	Route::post('login', 'Api\UserController@login');
	Route::post('register', 'Api\UserController@register');
	Route::post('update-profile', 'Api\UserController@update');
	
	// label for mobile
	Route::get('label/{id}', 'Api\LabelController@show');

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
Route::post('v3/register', 'Api\User\UserController@register');
Route::post('v3/user-login', 'Api\User\UserController@userlogin');

Route::post('v3/favorite', 'Api\User\FavoriteController@store');
Route::post('v3/remove', 'Api\User\FavoriteController@delete');
Route::get('v3/list', 'Api\User\FavoriteController@index');


Route::post('v3/cart', 'Api\User\AddtocartController@store');
Route::post('v3/remove-cart', 'Api\User\AddtocartController@delete');
Route::get('v3/list-cart', 'Api\User\AddtocartController@index');

/*user login*/

/*change password*/
Route::post('v3/change-password', 'Api\User\UserController@changePassword');
Route::get('v3/category', 'Api\User\CategoryController@index');
Route::get('v3/sub-category/{category_id?}', 'Api\User\SubcategoryController@index');
Route::group([
    'middleware' => 'auth:api',
    'prefix'    => 'v3',
    'namespace' => '\Api\User'
], function(){ 
	Route::get('slide', 'SlideController@index');
	// Route::get('category', 'CategoryController@index');
	// Route::get('sub-category/{category_id?}', 'SubcategoryController@index');

	/*product*/
	Route::get('product', 'ProductController@index');
   	Route::get('search', 'ProductController@search');
   	Route::get('product-detail/{product_id}', 'ProductController@detail');
   	Route::get('product-category/{sub_category?}', 'ProductController@productcategory');

  	/*change profile*/
  	Route::post('change-profile', 'UserController@changeProfile');

  	Route::get('vendor', 'VendorController@index');
  	Route::get('vendor-detail/{vendor_id?}', 'VendorController@detail');

  	/*product popular*/
  	Route::get('popular', 'ProductController@popular');
  	Route::get('collection', 'AdvertiseController@index');
  	Route::get('help', 'HelpController@index');
  	Route::get('help-detail/{id?}', 'HelpController@detail');
  	Route::get('policy', 'PageController@index');
  	Route::get('contact', 'ContactController@index');
  	
  	/*p order*/
  	Route::post('post-order', 'ProductController@postorder');
    Route::get('list-order', 'ProductController@myorder');
    Route::get('order-detail', 'ProductController@orderdetail');
});


/*Route::post('v4/register', 'Api\Saller\UserController@register');
	Route::post('v4/login', 'UserController@login');
	Route::get('v4/product/{user_id}/{skip?}', 'Api\Saller\ProductController@index');
	Route::get('v4/product-pending/{user_id}/{skip?}', 'Api\Saller\ProductController@pendding');
	Route::get('v4/product-shipping/{user_id}/{skip?}', 'Api\Saller\ProductController@shipping');
	Route::get('v4/product-delivery/{user_id}/{skip?}', 'Api\Saller\ProductController@delivery');
	Route::get('v4/product-cancel/{user_id}/{skip?}', 'Api\Saller\ProductController@cancel');
	Route::get('v4/order-report/{user_id}', 'Api\Saller\ProductController@orderreport');
	Route::get('v4/shop-detail/{user_id}', 'Api\Saller\ShopController@index');
	Route::get('v4/about', 'Api\Saller\PageController@about');
	Route::get('v4/term', 'Api\Saller\PageController@term');


	Route::get('v4/product-report/{user_id}', 'Api\Saller\ProductController@preport');

	Route::get('v4/profile/{user_id?}', 'Api\Saller\UserController@profile');
	Route::get('v4/change-profile/{user_id?}', 'Api\Saller\UserController@changeProfile');
	Route::post('v4/change-password', 'Api\Saller\UserController@changePassword');
	
Route::post('v4/login', 'Api\Saller\UserController@login');*/
/*saller*/

Route::post('v4/login', 'Api\Saller\UserController@login');
Route::post('v4/login-fb', 'Api\Saller\UserController@login_fb');
Route::post('v4/find-user', 'Api\Saller\UserController@findUser');
Route::post('v4/setnew-password', 'Api\Saller\UserController@setNewPassword');

Route::get('v4/category', 'Api\Saller\CategoryController@parentCategory');
Route::get('v4/category-parent/{parent_id}', 'Api\Saller\CategoryController@category');
Route::get('v4/category-sub/{parent_id}/{sub_id}', 'Api\Saller\CategoryController@subCategory');
Route::get('v4/brand', 'Api\Saller\BrandController@index');
Route::get('v4/supplier', 'Api\Saller\SupplierController@index');
Route::get('v4/unit', 'Api\Saller\UnitController@index');

Route::group([
    'middleware' => 'auth:api',
    'prefix'    => 'v4',
    'namespace' => '\Api\Saller',
], function(){ 
	Route::get('product/{shop_id}/{skip?}', 'ProductController@index');
	Route::get('product-pending/{shop_id}/{skip?}', 'ProductController@pendding');
	Route::get('product-shipping/{shop_id}/{skip?}', 'ProductController@shipping');
	Route::get('product-delivery/{shop_id}/{skip?}', 'ProductController@delivery');
	Route::get('product-cancel/{shop_id}/{skip?}', 'ProductController@cancel');
	Route::get('order-report/{shop_id}', 'ProductController@orderreport');
	Route::get('product-report/{user_id}', 'ProductController@productreport');
	// Route::get('shop-detail/{user_id}', 'ShopController@index');
	Route::get('about', 'PageController@about');
	Route::get('policy', 'PageController@policy');
	Route::get('saleononlineget', 'PageController@saleononlineget');

	Route::post('change-profile/{user_id?}', 'UserController@changeProfile');
	Route::post('change-password', 'UserController@changePassword');
		
	Route::post('add-product', 'ProductController@addProduct');
	Route::post('delete-product', 'ProductController@deleteProduct');
	Route::get('profile/{user_id?}', 'UserController@profile');
	Route::get('product-onsale/{user_id}/{skip?}', 'ProductController@onsale');
	Route::get('product-sold/{shop_id}/{skip?}', 'ProductController@sold');
	Route::get('shop-detail/{id}/{user_id}', 'ShopController@index');

	Route::post('profile-edit-username', 'UserController@editUsername');
	Route::post('profile-edit-email', 'UserController@editEmail');
	Route::post('profile-edit-phone', 'UserController@editPhone');
	Route::post('profile-edit-address', 'UserController@editAddress');
	Route::post('profile-edit-bio', 'UserController@editBio');
	Route::post('profile-edit-profile', 'UserController@editProfile');
	
	Route::post('shop-edit-name', 'ShopController@editShopName');
	Route::post('shop-edit-email', 'ShopController@editShopEmail');
	Route::post('shop-edit-phone', 'ShopController@editShopPhone');
	Route::post('shop-edit-address', 'ShopController@editShopAddress');
	Route::post('shop-edit-detail', 'ShopController@editShopDetail');
	Route::post('shop-edit-logo', 'ShopController@editShopLogo');
	Route::post('shop-edit-cover', 'ShopController@editShopCover');
	Route::post('shop-create', 'ShopController@createShop');

	Route::get('product-all-item/{shop_id}/{user_id}', 'ProductController@getItemAllOrder');
	Route::get('product-pending-item/{shop_id}/{user_id}', 'ProductController@getItemPendingOrder');
	Route::get('product-shipping-item/{shop_id}/{user_id}', 'ProductController@getItemShippingOrder');
	Route::get('product-delivery-item/{shop_id}/{user_id}', 'ProductController@getItemDeliveryOrder');
	Route::get('product-canceled-item/{shop_id}/{user_id}', 'ProductController@getItemCanceledOrder');

	Route::get('category-show/{category_id}/{parent_id}/{sub_id}', 'CategoryController@showCategory');
	Route::get('brand-show/{brand_id}', 'BrandController@showBrand');
	Route::get('unit-show/{unit_id}', 'UnitController@showUnit');
	Route::get('supplier-show/{supplier_id}', 'SupplierController@showSupplier');

	Route::get('gallery/{product_id}', 'GalleryController@getGalleries');

	Route::post('product-edit-name', 'ProductController@editProductName');
	Route::post('product-edit-qty', 'ProductController@editProductQty');
	Route::post('product-edit-sellprice', 'ProductController@editProductSellPrice');
	Route::post('product-edit-category', 'ProductController@editProductCategory');
	Route::post('product-edit-brand', 'ProductController@editProductBrand');
	Route::post('product-edit-supplier', 'ProductController@editProductSupplier');
	Route::post('product-edit-unit', 'ProductController@editProductUnit');
	Route::post('product-edit-video', 'ProductController@editProductVideo');
	Route::post('product-edit-des', 'ProductController@editProductDes');

	Route::post('pending-accept', 'ProductController@acceptPending');
	Route::post('pending-denied', 'ProductController@deniedPending');
	Route::post('shipping-accept', 'ProductController@acceptShipping');
});