<?php

namespace App\Http\Controllers;

class SigninController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSignin()
    {
        return view('templates\signin'); 
    }
}
