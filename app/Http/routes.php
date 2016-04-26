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
	Route::post('','CustomerRegistrationController@store');
});


Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'CustomerRegistrationController@confirm'
]);

Route::group(['prefix' => '/api/v1/products'], function () {
	Route::get('/catalog', 'ControllerProducts@getCatalog');
	Route::get('/find','ControllerProducts@findProductName');

});
