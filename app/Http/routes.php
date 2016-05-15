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

Route::group(['middleware' => 'web'], function () {

    // Route::get('/homepage', 'HomeController@index');

    Route::get('/', 'HomeController@showHomepage');

    // Route::get('/signin', 'SigninController@showSignin');

    Route::get('/signup', 'SignupController@showSignup');

    Route::get('/adminSignUp', function(){
        return view ('admin.adminSignUp');
    });

    Route::get('/signuppembeli', 'SignuppembeliController@showSignuppembeli');

    Route::get('/sellerSignUp', 'SignuppenjualController@showSignuppenjual');

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
    Route::resource('profile', 'ProfileController@index');

    Route::resource('adminProfile', 'adminController@index');

    Route::resource('admin', 'adminController');

    Route::resource('sellerProfile', 'sellerController@index');

    Route::resource('seller', 'sellerController');

    Route::resource('buyer', 'buyerController');

    Route::resource('produkTani', 'TaniController');

    Route::resource('produkTernak', 'TernakController');

    Route::resource('produkWisata', 'WisataController');

    Route::resource('produkVilla', 'VillaController');

    Route::resource('produkEdukasi', 'EdukasiController');

});

Route::group(['prefix' => '/api/v1/customers', 'middleware' => 'throttle'], function () {
    Route::post('/registration','CustomerController@store');
    Route::post('/login','CustomerController@getLogin');    
    Route::post('/update/login','CustomerController@updateLogin');
    Route::post('/update/address','CustomerController@updateAddress');
});

Route::group(['prefix' => '/api/v1/reservation', 'middleware' => 'throttle'], function () {
    Route::post('/store','ReservationsController@store');
});


Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'CustomerController@confirm'
]);

Route::post('/api/v1/request/password/', [
    'as' => 'forgotpassword_path',
    'uses' => 'CustomerController@requestLinkPassword'
]);

Route::get('reset/password/{confirmationCode}', [
    'as' => 'forgotpassword_path',
    'uses' => 'CustomerController@getLinkPassword'
]);

Route::post('reset/password', [
    'as' => 'resetpassword_path',
    'uses' => 'CustomerController@reset'
]);


Route::group(['prefix' => '/api/v1/products'], function () {
    Route::get('/catalog', 'ProductsController@getCatalog');
    Route::get('/find','ProductsController@findProductName');

});
