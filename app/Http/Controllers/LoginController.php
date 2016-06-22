<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\ Session as Session;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Redirect as Redirect;

use Illuminate\Foundation\Auth\ThrottlesLogins;

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
	    	'status' 	=> 1,
	        'email' 	=> Input::get('email'),
	        'password' 	=> Input::get('password')
	    ];
	
	    if ( ! Auth::attempt($credentials))
	    {
	      Session::flash('alert-class', 'alert-danger');
	      Session::flash('message', 'Email belum di konfirmasi, silahkan cek email anda! Atau kombinasi email dan password tidak sesuai!');
	      return Redirect::to('login');
	    }
	
	    return Redirect::to('/');
	}
}
