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

Route::auth();

// Route::get('/CustomerSignUp', function(){
// 	return view('customer.CustomerSignUp');
// });



Route::group(['middleware' => 'web'], function () {
	
	Route::get('/', 'HomeController@index');

	Route::get('/signup', 'SignupController@showSignup');

    Route::get('/AdminSignUp', function(){
        return view('admin.AdminSignUp');
    });

	Route::get('/CustomerSignUp', 'CustomerSignUpController@showCustomerSignUp');

    Route::get('/SellerSignUp', 'SellerSignUpController@showSellerSignUp');

    Route::get('/single-product', 'SingleproductController@showSingleproduct');

    Route::get('/lost-password', 'LostpasswordController@showLostpassword');

    Route::get('/katalogpariwisata', 'KatalogpariwisataController@showKatalogpariwisata');

    Route::get('/katalogdomba', 'KatalogdombaController@showKatalogdomba');

    Route::get('/katalogsapi', 'KatalogsapiController@showKatalogsapi');

    Route::get('/cart', 'CartController@showCart');


    // Route::resource('user/profile', 'UserController');

    // Route::resource('user/editProfile', 'UserController@editProfile');

    // Route::resource('merchant/product', 'ProductController');

    // Route::resource('merchant/create', 'ProductController@create');

    // -----------------------------------------------------------------------
    // Route::resource('profile', 'ProfileController@index');

    Route::resource('adminProfile', 'adminController@index');

    Route::resource('admin', 'adminController');

    Route::resource('sellerProfile', 'sellerController@index');

    Route::resource('seller', 'sellerController');

    Route::resource('buyerProfile', 'buyerController@index');

    Route::resource('buyer', 'buyerController');

    Route::resource('produkTani', 'TaniController');

    Route::resource('produkTernak', 'TernakController');

    Route::resource('produkWisata', 'WisataController');

    Route::resource('produkVilla', 'VillaController');

    Route::resource('produkEdukasi', 'EdukasiController');

});

// Route::get('/test', 'ApiTestController@test');

/// Route Mobile App
Route::group(['prefix' => '/api/v1/customers', 'middleware' => 'api'], function () {
    Route::post('/registration','ApiCustomerController@store');
    Route::post('/login','ApiCustomerController@getLogin');    
    Route::post('/maintainLogin','ApiCustomerController@maintainLogin');
    Route::post('/updateAddress','ApiCustomerController@updateAddress');
});

Route::group(['prefix' => '/api/v1/products', 'middleware' => 'api'], function () {
    Route::get('/catalog', 'ApiProductsController@getCatalog');
    Route::get('/find','ApiProductsController@findProductName');
});

Route::group(['prefix' => '/api/v1/reservation', 'middleware' => 'api'], function () {
    Route::post('/store', 'ApiReservationsController@store');
    Route::get('/getReservation', 'ApiReservationsController@getReservation');
    Route::post('/paymentConfirmation', 'ApiReservationsController@paymentConfirmation');
});


Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'ApiCustomerController@confirm'
]);

Route::post('/api/v1/request/password', [
    'as' => 'forgotpassword_path',
    'uses' => 'ApiCustomerController@requestLinkPassword'
]);

Route::get('reset/password/{confirmationCode}', [
    'as' => 'forgotpassword_path',
    'uses' => 'ApiCustomerController@getLinkPassword'
]);

Route::post('reset/password', [
    'as' => 'resetpassword_path',
    'uses' => 'ApiCustomerController@reset'
]);

