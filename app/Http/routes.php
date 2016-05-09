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
