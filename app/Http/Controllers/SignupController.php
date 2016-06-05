<?php

namespace App\Http\Controllers;

class SignupController extends Controller
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
    public function showSignup()
    {
        return view('templates\signup'); 
    }
}
