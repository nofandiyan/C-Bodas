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
    Route::post('register', 'RegistrationController@postRegister');
    Route::get('register/verify/{confirmationCode}', 'RegistrationController@confirm');

Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'HomeController@index');

	Route::get('/signup', 'SignupController@showSignup');

    Route::get('/AdminSignUp', 'AdminController@showSignup');

    Route::resource('AdminProfile', 'AdminController@index');

    Route::resource('admin', 'AdminController');

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

    // --------------------------------------------------------------------------

    Route::get('/single-product', 'SingleproductController@showSingleproduct');

    Route::get('/lost-password', 'LostpasswordController@showLostpassword');

    Route::get('/katalogpertanian', 'KatalogController@showKatalogpertanian');

    Route::get('/katalogpeternakan', 'KatalogController@showKatalogpeternakan');

    Route::get('/katalogpariwisata', 'KatalogController@showKatalogpariwisata');

    //Route::get('/katalogdomba', 'KatalogController@showKatalogdomba');

    //Route::get('/katalogsapi', 'KatalogController@showKatalogsapi');

    //Route::get('/katalogvilla', 'KatalogController@showKatalogvilla');

    Route::get('/cart', 'CartController@showCart');

    // -----------------------------------------------------------------------
    // Route::resource('profile', 'ProfileController@index');

});

// Route::get('/test', 'ApiTestController@test');


// Route Mobile App
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


// Route::get('register/verify/{confirmationCode}', [
//     'as' => 'confirmation_path',
//     'uses' => 'ApiCustomerController@confirm'
// ]);

Route::post('/api/v1/request/password', [
    'as' => 'forgotpassword_path',
    'uses' => 'ApiCustomerController@requestLinkPassword'
]);

// Route::get('reset/password/{confirmationCode}', [
//     'as' => 'forgotpassword_path',
//     'uses' => 'ApiCustomerController@getLinkPassword'
// ]);

Route::post('reset/password', [
    'as' => 'resetpassword_path',
    'uses' => 'ApiCustomerController@reset'
]);

