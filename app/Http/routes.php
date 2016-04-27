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
});


Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'CustomerController@confirm'
]);

Route::get('forgot/password/{confirmationCode}', [
    'as' => 'forgotpassword_path',
    'uses' => 'CustomerController@forgot'
]);

Route::post('reset/password', [
    'as' => 'resetpassword_path',
    'uses' => 'CustomerController@reset'
]);




Route::group(['prefix' => '/api/v1/products'], function () {
	Route::get('/catalog', 'ControllerProducts@getCatalog');
	Route::get('/find','ControllerProducts@findProductName');

});
