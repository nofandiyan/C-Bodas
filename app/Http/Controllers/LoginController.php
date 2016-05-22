<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\ Session as Session;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Redirect as Redirect;

use Auth;

class LoginController extends Controller
{
    public function postLogin()
	{
	  $rules = [
	        'email' => 'required|exists:users',
	        'password' => 'required'
	    ];
	
	    $input = Input::only('email', 'password');
	
	    $validator = Validator::make($input, $rules);
	
	    if($validator->fails())
	    {
	        return Redirect::to('login')->withInput()->withErrors($validator);
	    }
	
	    $credentials = [
	        'email' => Input::get('email'),
	        'password' => Input::get('password'),
	        'status' => 1
	    ];
	
	    if ( ! Auth::attempt($credentials))
	    {
	      Session::flash('alert-class', 'alert-danger');
	      Session::flash('message', 'Email belum di konfirmasi, Silahkan cek email anda!');
	      return Redirect::to('login');
	    }
	
	    return Redirect::to('/');
	}
}
