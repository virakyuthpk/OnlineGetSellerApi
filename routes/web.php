<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/wing-payment',['as'=> 'wing-payment', 'uses'=>
    'Frontend\FrontendController@wingpayment']);
    
//Route::get('/app-payment-return',['as'=> 'app-payment-return', 'uses'=>'Frontend\FrontendController@appreturnpayment']);

Route::get('/',['as'=> 'home', 'uses'=>
    'Frontend\FrontendController@index']);
Route::get('about',['as'=> 'about', 'uses'=>
    'Frontend\FrontendController@about']);
Route::post('comment',['as'=> 'comment', 'uses'=>
    'Frontend\FrontendController@Comment']);
Route::get('product-detail/{id}',['as' => 'product-detail','uses' => 'Frontend\FrontendController@proDetail']);
Route::get('product-category/{id?}',['as' => 'product-category','uses' => 'Frontend\FrontendController@productbycategory']);
Route::get('howtobuy',['as'=> 'howtobuy', 'uses'=>
    'Frontend\FrontendController@toBuy']);
Route::get('/return',['as'=> 'return', 'uses'=>
    'Frontend\FrontendController@retun']);
Route::get('/dilivery',['as'=> 'dilivery', 'uses'=>
    'Frontend\FrontendController@dilive']);
Route::get('/contactus',['as'=> 'contactus', 'uses'=>
    'Frontend\FrontendController@Contact']);
Route::get('/aboutus',['as'=> 'aboutus', 'uses'=>
    'Frontend\FrontendController@aboutUs']); 
Route::get('/sale',['as'=> 'sale', 'uses'=>
    'Frontend\FrontendController@sale']);
Route::get('/team-detail/{id?}',['as'=> 'team-detail', 'uses'=>
    'Frontend\FrontendController@teamdetail']); 
Route::post('/addtocart',['as'=> 'addtocart', 'uses'=>
    'Frontend\FrontendController@addtocart']); 
Route::get('/carts',['as'=> 'carts', 'uses'=>
    'Frontend\FrontendController@showcart']);  
Route::post('/removecart',['as'=> 'removecart', 'uses'=>
    'Frontend\FrontendController@removecart']);      
Route::get('/career',['as'=> 'career', 'uses'=>
    'Frontend\FrontendController@career']); 
// Login Frontend

Route::get('member-confirm-reset/{token}',['as' => 'member-confirm-reset', 'uses' => 'Frontend\JoinusController@confirmReset']);
Route::post('member-reset-new-password',['as' => 'member-reset-new-password', 'uses' => 'Frontend\JoinusController@resetNewPass']);
Route::post('/store',['as' => 'store','uses' => 'Frontend\JoinusController@store']);

Route::get('/activate/{code}',['as' => 'activate','uses' => 'Frontend\JoinusController@activate']);

Route::get('/member-login',['as' => 'member-login','uses' => 'Frontend\JoinusController@getlogin']);

Route::post('/member-login',['as' => 'member-login','uses' => 'Frontend\JoinusController@postLogin']);

Route::get('/member-forget-password', ['as' => 'member-forget-password', 'uses' => 'Frontend\JoinusController@forgetPassword']);

Route::post('member-verify-email', ['as' => 'member-verify-email', 'uses' => 'Frontend\JoinusController@verifyEmail']);

Route::post('/subscriber',['as' => 'subscriber','uses' => 'Frontend\FrontendController@postsubscrib']);

// admin
Route::get('admin-login', ['as' => 'admin-login', 'uses' => 'Administrator\UserController@login']);
Route::post('/post-login',['as' => 'post-login','uses' => 'Administrator\UserController@postLogin']);
Route::get('forget-password', ['as' => 'forget-password', 'uses' => 'Administrator\UserController@forgetPassword']);
Route::post('verify-email', ['as' => 'verify-email', 'uses' => 'Administrator\UserController@verifyEmail']);
Route::get('confirm-reset/{token}',['as' => 'confirm-reset', 'uses' => 'Administrator\UserController@confirmReset']);
Route::post('reset-new-password',['as' => 'reset-new-password', 'uses' => 'Administrator\UserController@resetNewPass']);
// search
Route::get('search',['as' => 'search', 'uses' => 'Frontend\FrontendController@search']);
// middle admin
Route::group(['middleware' => ['web','admin']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/vendor-list', ['as' => 'vendor-list', 'uses' => 'Frontend\VendorController@vendorlist']);
        Route::get('/active_vendor', ['as' => 'active_vendor', 'uses' => 'Frontend\VendorController@activevendor']);
        Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Administrator\UserController@dashboard']);
        Route::get('/users',['as' => 'users','uses' => 'Administrator\UserController@index']);
        Route::get('/logout',['as' => 'admin-logout','uses' => 'Administrator\UserController@logout']);
        Route::post('update-reset-pass',['as' => 'update-reset-pass', 'uses' => 'Administrator\UserController@updateResetPass']);
        Route::get('register', ['as' => 'register', 'uses' => 'Administrator\UserController@register']);
        Route::get('/users-create',['as' => 'users-create','uses' => 'Administrator\UserController@create']);
        Route::post('/post-user',['as' => 'post-user','uses' => 'Administrator\UserController@store']);
         Route::get('/edit-user/{id}',['as' => 'edit-user','uses' => 'Administrator\UserController@edit']);
          Route::post('/post-edit-user',['as' => 'post-edit-user','uses' => 'Administrator\UserController@postEditUser']);
           Route::get('/delete-user',['as' => 'delete-user','uses' => 'Administrator\UserController@destroy']);
            /* page*/
        Route::get('/pages', ['as' => 'pages', 'uses' => 'Administrator\PagesController@index']);
        Route::get('/page/create', ['as' => 'page-create', 'uses' => 'Administrator\PagesController@create']);
        Route::post('/post-page/{id?}', ['as' => 'post-page', 'uses' => 'Administrator\PagesController@store']);
        Route::get('/edit/page/{id}', ['as' => 'edit-page', 'uses' => 'Administrator\PagesController@edit']);
        Route::get('/delete/page', ['as' => 'delete-page', 'uses' => 'Administrator\PagesController@destroy']);
        // end
        /* help*/
        Route::get('/helps', ['as' => 'helps', 'uses' => 'Administrator\HelpController@index']);
        Route::get('/help/create', ['as' => 'help-create', 'uses' => 'Administrator\HelpController@create']);
        Route::post('/post-help/{id?}', ['as' => 'post-help', 'uses' => 'Administrator\HelpController@store']);
        Route::get('/edit/help/{id}', ['as' => 'edit-help', 'uses' => 'Administrator\HelpController@edit']);
        Route::get('/delete/help', ['as' => 'delete-help', 'uses' => 'Administrator\HelpController@destroy']);
            /*partner*/
        Route::get('/partner', ['as' => 'partner', 'uses' => 'Administrator\PartnerController@index']);
        Route::get('/partner/create', ['as' => 'partner-create', 'uses' => 'Administrator\PartnerController@create']);
        Route::post('/post/partner/{id?}', ['as' => 'post-partner', 'uses' => 'Administrator\PartnerController@store']);
        Route::get('/edit/partner/{id}', ['as' => 'edit-partner', 'uses' => 'Administrator\PartnerController@edit']);
        Route::get('/delete-partner', ['as' => 'delete-partner', 'uses' => 'Administrator\PartnerController@destroy']);
        Route::get('/active-partner', ['as' => 'active-partner', 'uses' => 'Administrator\PartnerController@active']);
        /*slide*/
        Route::get('/slide-show', ['as' => 'slide-show', 'uses' => 'Administrator\SlideShowController@index']);
        Route::get('/slide-show/create', ['as' => 'slide-show-create', 'uses' => 'Administrator\SlideShowController@create']);
        Route::post('/post/slide-show/{id?}', ['as' => 'post-slide', 'uses' => 'Administrator\SlideShowController@store']);
        Route::get('/edit/slide-show/{id}', ['as' => 'edit-slide', 'uses' => 'Administrator\SlideShowController@edit']);
        Route::get('/delete/slide-show', ['as' => 'delete-slide', 'uses' => 'Administrator\SlideShowController@destroy']);
        Route::get('/active-slid', ['as' => 'active-slid', 'uses' => 'Administrator\SlideShowController@active']);

        /*slide*/
        Route::get('/payment', ['as' => 'payment', 'uses' => 'Administrator\PaymentController@index']);
        Route::get('/payment/create', ['as' => 'payment-create', 'uses' => 'Administrator\PaymentController@create']);
        Route::post('/post/payment/{id?}', ['as' => 'post-payment', 'uses' => 'Administrator\PaymentController@store']);
        Route::get('/edit/payment/{id}', ['as' => 'edit-payment', 'uses' => 'Administrator\PaymentController@edit']);
        Route::get('/delete/payment', ['as' => 'delete-payment', 'uses' => 'Administrator\PaymentController@destroy']);
        Route::get('/active-payment', ['as' => 'active-payment', 'uses' => 'Administrator\PaymentController@active']);

         /* address*/
       Route::get('/address',['as' => 'address','uses' => 'Administrator\AddressController@index']);
        Route::post('/post-address/{id?}',['as' => 'post-address','uses' => 'Administrator\AddressController@store']);
        Route::get('/edit/address/{id}',['as' => 'edit-address','uses' => 'Administrator\AddressController@edit']);
        /*Advertise*/
         Route::get('advertise', ['as' => 'advertise', 'uses' => 'Administrator\AdvertiseController@index']);
        Route::get('/advertise-create', ['as' => 'advertise-create', 'uses' => 'Administrator\AdvertiseController@create']);
        Route::post('/post/advertise/{id?}', ['as' => 'post-advertise', 'uses' => 'Administrator\AdvertiseController@store']);
         Route::get('/edit/advertise/{id}', ['as' => 'edit-advertise', 'uses' => 'Administrator\AdvertiseController@edit']);
          Route::get('/delete/add', ['as' => 'delete-add', 'uses' => 'Administrator\AdvertiseController@destroy']);
          Route::get('activ-add', ['as' => 'activ-add', 'uses' => 'Administrator\AdvertiseController@active']);
          
          /*Logo*/
         Route::get('logo', ['as' => 'logo', 'uses' => 'Administrator\LogoController@index']);
        Route::get('/logo-create', ['as' => 'logo-create', 'uses' => 'Administrator\LogoController@create']);
        Route::post('/post/logo/{id?}', ['as' => 'post-logo', 'uses' => 'Administrator\LogoController@store']);
         Route::get('/edit/logo/{id}', ['as' => 'edit-logo', 'uses' => 'Administrator\LogoController@edit']);
         
          // categories
          Route::get('category', ['as' => 'category', 'uses' => 'Administrator\CategoryController@index']);
           Route::get('/category-create', ['as' => 'category-create', 'uses' => 'Administrator\CategoryController@create']);
           Route::post('/post/category/{id?}', ['as' => 'post-category', 'uses' => 'Administrator\CategoryController@store']);
           Route::get('/edit-category/{id}', ['as' => 'edit-category', 'uses' => 'Administrator\CategoryController@edit']);
            Route::get('/active-category', ['as' => 'active-category', 'uses' => 'Administrator\CategoryController@active']);
            Route::get('/delete-category', ['as' => 'delete-category', 'uses' => 'Administrator\CategoryController@destroy']);
            /*subcategory*/
            Route::get('sub-category/{id?}',['as' => 'sub-category', 'uses' => 'Administrator\CategoryController@subcategory']);
             Route::get('child-category/{id?}',['as' => 'child-category', 'uses' => 'Administrator\CategoryController@childcategory']);
           // Product
            Route::get('/product', ['as' => 'product', 'uses' => 'Administrator\ProductController@index']);
            Route::get('/create-product/{id?}', ['as' => 'create-product', 'uses' => 'Administrator\ProductController@create']);
            Route::post('photos/product',['as' => 'admin-photos-product', 'uses' => 'Administrator\ProductController@addPhotosProduct']);
            Route::post('photos/products',['as' => 'photos/products', 'uses' => 'Administrator\ProductController@uploadProductPhotoss']);
            Route::post('/post-product',['as' => 'post-product', 'uses' => 'Administrator\ProductController@postProduct']);
            Route::get('/edit-product/{id?}', ['as' => 'edit-product', 'uses' => 'Administrator\ProductController@create']);
            Route::get('remove-photo-pro',['as' => 'remove-photo-pro', 'uses' => 'Administrator\ProductController@removePhotoPro']);
            Route::get('delete/photo/pro', ['as' => 'delete/photo/pro', 'uses' => 'Administrator\ProductController@deletePro']);
            Route::get('/active-product', ['as' => 'active-product', 'uses' => 'Administrator\ProductController@active']);
            /*Brand*/
          Route::get('brand', ['as' => 'brand', 'uses' => 'Administrator\BrandController@index']);
          Route::get('/brand-create', ['as' => 'brand-create', 'uses' => 'Administrator\BrandController@create']);
          Route::post('/post/brand/{id?}', ['as' => 'post-brand', 'uses' => 'Administrator\BrandController@store']);
          Route::get('/edit/brand/{id}', ['as' => 'edit-brand', 'uses' => 'Administrator\BrandController@edit']);
          Route::get('/delete/brand', ['as' => 'delete-brand', 'uses' => 'Administrator\BrandController@destroy']);
          Route::get('active-brand', ['as' => 'active-brand', 'uses' => 'Administrator\BrandController@active']);

          /*Unit*/
          Route::get('unit', ['as' => 'unit', 'uses' => 'Administrator\UnitController@index']);
          Route::get('/unit-create', ['as' => 'unit-create', 'uses' => 'Administrator\UnitController@create']);
          Route::post('/post/unit/{id?}', ['as' => 'post-unit', 'uses' => 'Administrator\UnitController@store']);
          Route::get('/edit/unit/{id}', ['as' => 'edit-unit', 'uses' => 'Administrator\UnitController@edit']);
          Route::get('/delete/unit', ['as' => 'delete-unit', 'uses' => 'Administrator\UnitController@destroy']);
          Route::get('active-unit', ['as' => 'active-unit', 'uses' => 'Administrator\UnitController@active']);

          /*Discount*/
        Route::get('discount', ['as' => 'discount', 'uses' => 'Administrator\DiscountController@index']);
        Route::get('/discount-create', ['as' => 'discount-create', 'uses' => 'Administrator\DiscountController@create']);
        Route::post('/post/discount/{id?}', ['as' => 'post-discount', 'uses' => 'Administrator\DiscountController@store']);
        Route::get('/edit/discount/{id}', ['as' => 'edit-discount', 'uses' => 'Administrator\DiscountController@edit']);
        Route::get('/delete/discount', ['as' => 'delete-discount', 'uses' => 'Administrator\DiscountController@destroy']);
        Route::get('active-discount', ['as' => 'active-discount', 'uses' => 'Administrator\DiscountController@active']);

         /*Campaign*/
        Route::get('campaign', ['as' => 'campaign', 'uses' => 'Administrator\CampaignController@index']);
        Route::get('/campaign-create', ['as' => 'campaign-create', 'uses' => 'Administrator\CampaignController@create']);
        Route::post('/post/campaign/{id?}', ['as' => 'post-campaign', 'uses' => 'Administrator\CampaignController@store']);
        Route::get('/edit/campaign/{id}', ['as' => 'edit-campaign', 'uses' => 'Administrator\CampaignController@edit']);
        Route::get('/delete/campaign', ['as' => 'delete-campaign', 'uses' => 'Administrator\CampaignController@destroy']);
        Route::get('active-campaign', ['as' => 'active-campaign', 'uses' => 'Administrator\CampaignController@active']);

          /*Varain*/
          Route::get('variant', ['as' => 'variant', 'uses' => 'Administrator\VariantController@index']);
          Route::get('/variant-create', ['as' => 'variant-create', 'uses' => 'Administrator\VariantController@create']);
          Route::post('/post/variant/{id?}', ['as' => 'post-variant', 'uses' => 'Administrator\VariantController@store']);
          Route::get('/edit/variant/{id}', ['as' => 'edit-variant', 'uses' => 'Administrator\VariantController@edit']);
          Route::get('/delete/variant', ['as' => 'delete-variant', 'uses' => 'Administrator\VariantController@destroy']);
          Route::get('active-variant', ['as' => 'active-variant', 'uses' => 'Administrator\VariantController@active']);

          /*Supplier*/
          Route::get('supplier', ['as' => 'supplier', 'uses' => 'Administrator\SupplierController@index']);
          Route::get('/supplier-create', ['as' => 'supplier-create', 'uses' => 'Administrator\SupplierController@create']);
          Route::post('/post/supplier/{id?}', ['as' => 'post-supplier', 'uses' => 'Administrator\SupplierController@store']);
          Route::get('/edit/supplier/{id}', ['as' => 'edit-supplier', 'uses' => 'Administrator\SupplierController@edit']);
          Route::get('/delete/supplier', ['as' => 'delete-supplier', 'uses' => 'Administrator\SupplierController@destroy']);
          Route::get('active-supplier', ['as' => 'active-supplier', 'uses' => 'Administrator\SupplierController@active']);

          /*Customer*/
          Route::get('customer', ['as' => 'customer', 'uses' => 'Administrator\CustomerController@index']);
          Route::get('/customer-create', ['as' => 'customer-create', 'uses' => 'Administrator\CustomerController@create']);
          Route::post('/post/customer/{id?}', ['as' => 'post-customer', 'uses' => 'Administrator\CustomerController@store']);
          Route::get('/edit/customer/{id}', ['as' => 'edit-customer', 'uses' => 'Administrator\CustomerController@edit']);
          Route::get('/delete/customer', ['as' => 'delete-customer', 'uses' => 'Administrator\CustomerController@destroy']);
          Route::get('active-customer', ['as' => 'active-customer', 'uses' => 'Administrator\CustomerController@active']);
          /*  village*/

    Route::get('/village', ['as' => 'village', 'uses' => 'Administrator\VillageController@index']);
    Route::get('/village/create', ['as' => 'village-create', 'uses' => 'Administrator\VillageController@create']);
    Route::post('post-village/{id?}', ['as' => 'post-village', 'uses' => 'Administrator\VillageController@store']);
    Route::get('edit/village/{id}', ['as' => 'edit-village', 'uses' => 'Administrator\VillageController@edit']);
    Route::get('delete/village', ['as' => 'delete-village', 'uses' => 'Administrator\VillageController@destroy']);
    // end
    // commuune
Route::get('/commune', ['as' => 'commune', 'uses' => 'Administrator\CommuneController@index']);
    Route::get('/commune/create', ['as' => 'commune-create', 'uses' => 'Administrator\CommuneController@create']);
    Route::post('post-commune/{id?}', ['as' => 'post-commune', 'uses' => 'Administrator\CommuneController@store']);
    Route::get('edit/commune/{id}', ['as' => 'edit-commune', 'uses' => 'Administrator\CommuneController@edit']);
    Route::get('delete/commune', ['as' => 'delete-commune', 'uses' => 'Administrator\CommuneController@destroy']);
    // end
    // district
    Route::get('/district', ['as' => 'district', 'uses' => 'Administrator\DistrictController@index']);
    Route::get('/district/create', ['as' => 'district-create', 'uses' => 'Administrator\DistrictController@create']);
    Route::post('post-district/{id?}', ['as' => 'post-district', 'uses' => 'Administrator\DistrictController@store']);
    Route::get('edit/district/{id}', ['as' => 'edit-district', 'uses' => 'Administrator\DistrictController@edit']);
    Route::get('delete/district', ['as' => 'delete-district', 'uses' => 'Administrator\DistrictController@destroy']);
    Route::get('district-actived', ['as' => 'district-actived', 'uses' => 'Administrator\DistrictController@actived']);
    /*end district*/
    /*province*/
    Route::get('/province', ['as' => 'province', 'uses' => 'Administrator\ProvinceController@index']);
    Route::get('/province/create', ['as' => 'province-create', 'uses' => 'Administrator\ProvinceController@create']);
    Route::post('post-province/{id?}', ['as' => 'post-province', 'uses' => 'Administrator\ProvinceController@store']);
    Route::get('edit/province/{id}', ['as' => 'edit-province', 'uses' => 'Administrator\ProvinceController@edit']);
    Route::get('delete/province', ['as' => 'delete-province', 'uses' => 'Administrator\ProvinceController@destroy']);
    Route::get('province-actived', ['as' => 'province-actived', 'uses' => 'Administrator\ProvinceController@active']);
    /*end province*/


      /*team*/
         Route::get('/team',['as' => 'team','uses' => 'Administrator\TeamController@index']);
        Route::get('/team/create',['as' => 'team-create','uses' => 'Administrator\TeamController@create']);
        Route::post('/post-team/{id?}',['as' => 'post-team','uses' => 'Administrator\TeamController@store']);
        Route::get('/edit/team/{id}',['as' => 'edit-team','uses' => 'Administrator\TeamController@edit']);
        Route::get('delete/team',['as' => 'delete-team','uses' => 'Administrator\TeamController@destroy']);
        Route::get('/active-team', ['as' => 'active-team', 'uses' => 'Administrator\TeamController@active']); 
        
        // end
        Route::get('/product-order', ['as' => 'product-order', 'uses' => 'Administrator\ProductController@productorder']);
        // comment
        Route::get('/list-comment', ['as' => 'list-comment', 'uses' => 'Administrator\CommentController@listComment']);
        /*job*/
        Route::get('/job',['as' => 'job','uses' => 'Administrator\CareerController@index']);
        Route::get('/job/create',['as' => 'job-create','uses' => 'Administrator\CareerController@create']);
        Route::post('/post-job/{id?}',['as' => 'post-job','uses' => 'Administrator\CareerController@store']);
        Route::get('/edit/job/{id}',['as' => 'edit-job','uses' => 'Administrator\CareerController@edit']);
        Route::get('delete/job',['as' => 'delete-job','uses' => 'Administrator\CareerController@destroy']);
        Route::get('/active-job', ['as' => 'active-job', 'uses' => 'Administrator\CareerController@active']);
        /*end*/
        /*leftslide*/
        Route::get('leftslide', ['as' => 'leftslide', 'uses' => 'Administrator\LeftslideController@index']);
        Route::get('/leftslide-create', ['as' => 'leftslide-create', 'uses' => 'Administrator\LeftslideController@create']);
        Route::post('/post/leftslide/{id?}', ['as' => 'post-leftslide', 'uses' => 'Administrator\LeftslideController@store']);
         Route::get('/edit/leftslide/{id}', ['as' => 'edit-leftslide', 'uses' => 'Administrator\LeftslideController@edit']);
          Route::get('/delete/leftslide', ['as' => 'delete-leftslide', 'uses' => 'Administrator\LeftslideController@destroy']);
        Route::get('activ-leftslide', ['as' => 'activ-leftslide', 'uses' => 'Administrator\LeftslideController@active']);
        Route::get('visito-log', ['as' => 'visito-log', 'uses' => 'Administrator\VisitorController@index']);
    });
});

Route::group(['middleware' => ['web','member']], function () {
    Route::group(['prefix' => 'member'], function () {
          Route::get('/aproved',['as' => 'aproved','uses' => 'Frontend\MemberController@approved']);
        Route::get('acc_setting',['as' => 'acc_setting','uses' => 'Frontend\MemberController@accSetting']);
         Route::post('/Update_account',array('as' => 'Update_account','uses' => 'Frontend\MemberController@updateAccount'));   
         Route::post('/Update_pass',array('as' => 'Update_pass','uses' => 'Frontend\MemberController@updateAccPass')); 
        Route::get('order-history',['as' => 'order-history','uses' => 'Frontend\MemberController@orderhistory']);
        // order
        Route::get('order/{id}',['as' => 'order','uses' => 'Frontend\MemberController@order']);
        Route::get('dis-pro/{id?}',['as' => 'dis-pro', 'uses' => 'Frontend\MemberController@myformAjax']);
        Route::post('post-order',['as' => 'post-order', 'uses' => 'Frontend\MemberController@postOrder']);
        
    });
});
Route::get('member-logout',['as' => 'member-logout','uses' => 'Frontend\MemberController@logout']);
/* saller */
Route::group(['middleware' => ['web','saller']], function () {
    Route::group(['prefix' => 'saller'], function () {
      Route::get('/product-vendor', ['as' => 'product-vendor', 'uses' => 'Frontend\VendorController@index']);
      Route::get('/create-vendor-product/{id?}', ['as' => 'create-vendor-product', 'uses' => 'Frontend\VendorController@create']);
       Route::get('/edit-vendor-product/{id?}', ['as' => 'edit-vendor-product', 'uses' => 'Frontend\VendorController@create']);
      Route::post('/post-product-vendor',['as' => 'post-product-vendor', 'uses' => 'Frontend\VendorController@postProduct']);
       Route::get('vendor-sub-category/{id?}',['as' => 'vendor-sub-category', 'uses' => 'Frontend\VendorController@subcategory']);
        Route::get('/order-vendor-product', ['as' => 'order-vendor-product', 'uses' => 'Frontend\VendorController@OrderList']);
        Route::post('vendor/photos/products',['as' => 'vendor/photos/products', 'uses' => 'Administrator\ProductController@uploadProductPhotoss']);
        Route::post('photos/product',['as' => 'saller-photos-product', 'uses' => 'Administrator\ProductController@addPhotosProduct']);
        Route::get('vendor-remove-photo-pro',['as' => 'vendor-remove-photo-pro', 'uses' => 'Administrator\ProductController@removePhotoPro']);
        Route::get('delete/vendor/photo/pro', ['as' => 'delete/vendor/photo/pro', 'uses' => 'Frontend\VendorController@deletePro']);
        Route::get('/active-vendor-product', ['as' => 'active-vendor-product', 'uses' => 'Frontend\VendorController@active']);
       /*profile vendor*/ 
            Route::post('updatepassord', ['as' => 'updatepassord', 'uses' => 'Frontend\VendorController@updatePass']); 
            Route::get('/vendor-profile',['as' => 'vendor-profile','uses' => 'Frontend\VendorController@profile']);
            Route::get('/vendor-acount',['as' => 'vendor-acount','uses' => 'Frontend\VendorController@venAccount']);
            Route::get('/vendor-config/{id?}',['as' => 'vendor-config','uses' => 'Frontend\VendorController@venConfig']);
            Route::post('/post-vendor-config',['as' => 'post-vendor-config','uses' => 'Frontend\VendorController@postVenConfig']);
 });
});
/* end */ 

/*language*/

Route::get('switchLanguage/{lang}', function ($lang) {
    Session::put('language', $lang);
    return Redirect::back();
});

Route::get('province-distric/{id?}',['as' => 'province-distric', 'uses' => 'Frontend\FrontendController@myformAjax']);
Route::get('district-commune/{id?}',['as' => 'district-commune', 'uses' => 'Frontend\FrontendController@commune']);
/*order */



 