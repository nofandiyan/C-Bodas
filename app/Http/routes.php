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

Route::get('/CustomerSignUp', function(){
	return view('customer.CustomerSignUp');
});

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
});

/// Route Mobile App
Route::group(['prefix' => '/api/v1/customers', 'middleware' => 'throttle'], function () {
    Route::post('/registration','ApiCustomerController@store');
    Route::post('/login','ApiCustomerController@getLogin');    
    Route::post('/maintainLogin','ApiCustomerController@maintainLogin');
    Route::post('/update/address','ApiCustomerController@updateAddress');
});

Route::group(['prefix' => '/api/v1/reservation', 'middleware' => 'throttle'], function () {
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


Route::group(['prefix' => '/api/v1/products'], function () {
    Route::get('/catalog', 'ApiProductsController@getCatalog');
    Route::get('/find','ApiProductsController@findProductName');

});