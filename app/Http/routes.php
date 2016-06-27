<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::auth();
// Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'LoginController@postLogin');
    $this->get('logout', 'Auth\AuthController@logout');
     
    // Password Reset Routes...
    $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    $this->post('password/reset', 'Auth\PasswordController@reset');
     
    // Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');    
    Route::post('registerAdmin', 'RegistrationController@postRegisterAdmin');
    Route::post('registerSeller', 'RegistrationController@postRegisterSeller');
    Route::post('registerCustomer', 'RegistrationController@postRegisterCustomer');
    Route::get('register/verify/{confirmationCode}', 'RegistrationController@confirm');

Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'HomeController@index');

	Route::get('/signup', 'SignupController@showSignup');

    Route::get('/AdminSignUp', 'AdminController@showSignup');

    Route::resource('AdminProfile', 'AdminController@index');

    Route::resource('admin', 'AdminController');

    Route::resource('viewAdminProfile', 'AdminController');

    Route::resource('SuperAdminProfile', 'SuperAdminController@index');

    Route::resource('SuperAdmin', 'SuperAdminController');

    Route::resource('seller', 'SellerController');
    Route::get('/SellerSignUp', 'SellerController@showSignUp');
    Route::resource('SellerProfile', 'SellerController@index');
    Route::resource('viewSellerProfile', 'SellerController');

    // Route::resource('bannedSeller', 'SellerController@bannedSeller');
    // Route::get('unBannedSeller', 'SellerController@unBannedSeller');

    Route::resource('customer', 'CustomerController');
    Route::get('/CustomerSignUp', 'CustomerController@showSignUp');
    Route::resource('CustomerProfile', 'CustomerController@index');
    Route::resource('viewCustomerProfile', 'CustomerController');

    Route::post('/createCategory', 'ProductController@createCategory');
    Route::get('/createTani', 'ProductController@createTani');
    Route::get('/createTernak', 'ProductController@createTernak');
    Route::get('/createWisata', 'ProductController@createWisata');

    Route::resource('Product', 'ProductController');

    Route::resource('Order', 'OrderController');

    Route::get('OrderAdmin/{resvId}', 'OrderController@OrderAdmin');
    Route::get('OrderValid/{resvId}', 'OrderController@OrderValid');
    Route::get('OrderInvalid/{resvId}', 'OrderController@OrderInvalid');
    Route::get('OrderAdminShipping/{resvId}', 'OrderController@OrderAdminShipping');


    Route::get('OrderPending/{resvId}', 'OrderController@orderPending');
    Route::get('OrderAccepted/{resvId}', 'OrderController@orderAccepted');
    Route::get('OrderRejected/{resvId}', 'OrderController@orderRejected');
    Route::get('OrderShipping/{resvId}', 'OrderController@OrderShipping');
    Route::get('OrderShipped/{resvId}', 'OrderController@OrderShipped');
    Route::get('OrderClosed/{resvId}', 'OrderController@OrderClosed');

    Route::get('/invalid/{id}', 'OrderController@invalid');
    Route::get('/valid/{id}', 'OrderController@valid');

    Route::get('/accepted/{resvId}/{detId}', 'OrderController@accepted');
    Route::get('/rejected/{resvId}/{detId}', 'OrderController@rejected');

    Route::post('/shipping/{resvId}/{detId}', 'OrderController@shipping');

    Route::get('/shippingTernak/{resvId}/{detId}', 'OrderController@shippingTernak');

    Route::get('/shipped/{resvId}/{detId}', 'OrderController@shipped');

    Route::get('/closed/{resvId}', 'OrderController@closed');

    Route::get('/transfer/{resvId}/{detId}', 'OrderController@transfer');

    // --------------------------------------------------------------------------

    Route::get('/single-product/{detailproductid}', 'KatalogController@showSingleproduct');

    Route::get('/lost-password', 'LostpasswordController@showLostpassword');

    Route::get('/katalogpertanian', 'KatalogController@showKatalogpertanian');

    Route::get('/katalogpeternakan', 'KatalogController@showKatalogpeternakan');

    Route::get('/katalogpariwisata', 'KatalogController@showKatalogpariwisata');

    Route::get('/katalogsayurorganik', 'KatalogController@showSayurorganik');

    Route::get('/katalogsayuranorganik', 'KatalogController@showSayuranorganik');

    Route::get('/katalogbuahorganik', 'KatalogController@showBuahorganik');

    Route::get('/katalogbuahanorganik', 'KatalogController@showBuahanorganik');



    

   // Route::get('/addProduct/{prodId}/{prodName}/{prodPriceId}', 'CartController@addCart');

   // Route::get('/single-product','katalogController@showSingleproduct');
    

    Route::get('/reviewrating', 'ReviewratingController@showreviewrating');

    Route::post('/reviewratingberhasil', 'ReviewratingController@insertreviewrating');

    Route::post('/single-product', array('uses'=>'CartController@additemsingleproduct'));

    Route::get('/checkout','CartController@alamatbaru');

    Route::post('/katalogsayuranorganik', array('uses'=>'CartController@additemsayuranorganik'));

    Route::post('/katalogsayurorganik', array('uses'=>'CartController@additemsayurorganik'));

    Route::post('/katalogbuahanorganik', array('uses'=>'CartController@additembuahanorganik'));

    Route::post('/katalogbuahorganik', array('uses'=>'CartController@additembuahorganik'));

    Route::post('/katalogpeternakan', array('uses'=>'CartController@additempeternakan'));

    Route::post('/katalogpariwisata', array('uses'=>'CartController@additempariwisata'));

    Route::any('/homepage', array('uses'=>'CartController@addhome'));

    Route::get('/buktipembayaranupdated','Confirmationcontroller@showconfirmation');

    Route::post('/searchresult', array('uses'=>'CartController@additemsearch'));

    Route::post('/checkout-payment', array('uses'=>'ApiShippingController@pilihongkir'));

    //Route::post('/single-product/{detailproductid}', array('uses'=>'CartController@additemsingleproduct'));
    //--------------------------------------------------------------------------

    Route::get('/searchresult', 'SearchController@cari');

    // Route::get('/stores', array('uses'=>'ApiShippingController@pilihongkir'));

    Route::post('/buktipembayaranupdated', 'ConfirmationController@paymentConfirmation');

    Route::get('/konfirmasipembayaran', 'ConfirmationController@showconfirmation');

    //-------------------------------------------------------------------------

    Route::post('/ordercomplete', 'CartController@postcart');

    Route::post('/checkout', 'CartController@addalamatbaru');

    Route::post('/checkout', 'CartController@addalamatlama');

    Route::post('/checkout-review', array('uses'=>'ApiShippingController@reviewpemesanan'));

    //Route::get('/checkout-review', 'ApiShippingController@reviewpemesanan');

    Route::get('checkout-shipping', 'ApiShippingController@hitungongkir');

    Route::get('/cart', 'testcart@a');

    Route::get('/checkout', 'CartController@order');

    Route::post('/cart/', 'CartController@removeItem');

    // Route::get('/single-product','KatalogController@detailProduct');
    // -----------------------------------------------------------------------
    // Route::resource('profile', 'ProfileController@index');

});

Route::get('/test', 'ApiTestController@test');


// Route Mobile App
Route::group(['prefix' => '/api/v1/customers', 'middleware' => 'api'], function () {
    Route::post('/registration','ApiCustomerController@store');
    Route::post('/login','ApiCustomerController@getLogin');    
    Route::post('/maintainLogin','ApiCustomerController@maintainLogin');
    Route::post('/updateAddress','ApiCustomerController@updateAddress');
    Route::post('/insertAddress', 'ApiCustomerController@insertDelivAddress');
    Route::post('/updatePassword', 'ApiCustomerController@changePassword');
    Route::get('/getProvinces', 'ApiCustomerController@getProvinces');
    Route::get('/getCities', 'ApiCustomerController@getCities');
    Route::post('/updateDeviceToken', 'ApiCustomerController@updateDeviceToken');
    Route::post('/notif', 'ApiCustomerController@testNotif');
});

Route::group(['prefix' => '/api/v1/products', 'middleware' => 'api'], function () {
    Route::get('/catalog', 'ApiProductsController@getCatalog');
    Route::get('/find','ApiProductsController@findProductName');
    Route::get('/detail','ApiProductsController@detailProduct');
    Route::post('/review', 'ApiProductsController@reviewProduct');
    Route::get('/getReview', 'ApiProductsController@getReview');
});

Route::group(['prefix' => '/api/v1/reservation', 'middleware' => 'api'], function () {
    Route::post('/store', 'ApiReservationsController@store');
    Route::get('/getReservation', 'ApiReservationsController@getReservation');
    Route::get('/detail', 'ApiReservationsController@getDetailReservation');
    Route::post('/paymentConfirmation', 'ApiReservationsController@paymentConfirmation');
});


Route::post('/api/v1/request/password', [
    'as' => 'forgotpassword_path',
    'uses' => 'ApiCustomerController@requestLinkPassword'
]);


Route::post('reset/password', [
    'as' => 'resetpassword_path',
    'uses' => 'ApiCustomerController@reset'
]);

