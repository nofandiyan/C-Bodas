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

Route::get('/', function () {
    return view('welcome');
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

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/homepage', 'HomeController@showHomepage');

    Route::get('/signin', 'SigninController@showSignin');

    Route::get('/signup', 'SignupController@showSignup');

    Route::get('/signuppembeli', 'SignuppembeliController@showSignuppembeli');

    Route::get('/signuppenjual', 'SignuppenjualController@showSignuppenjual');

    Route::get('/single-product', 'SingleproductController@showSingleproduct');

    Route::get('/lost-password', 'LostpasswordController@showLostpassword');

    Route::get('/katalogpariwisata', 'KatalogpariwisataController@showKatalogpariwisata');

    Route::get('/katalogdomba', 'KatalogdombaController@showKatalogdomba');

    Route::get('/katalogsapi', 'KatalogsapiController@showKatalogsapi');

    Route::get('/cart', 'CartController@showCart');

    Route::get('/', function(){
        if (!empty(Auth::user())) {
            if(Auth::user()->userAs == 1){
                return view ('templates/homepage');
            }else{
                return view('pembeli/pembeli_home');
            }
        }else{
            return view('templates/homepage');
        }
    });

Route::resource('user/profile', 'UserController');

    Route::resource('user/editProfile', 'UserController@editProfile');

    Route::resource('merchant/product', 'ProductController');

    Route::resource('merchant/create', 'ProductController@create');



});