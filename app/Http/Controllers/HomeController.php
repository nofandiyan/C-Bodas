<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\TaniModel;
use App\TernakModel;
use App\WisataModel;
use App\VillaModel;
use App\EdukasiModel;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function showHomepage()
    // {
    //     return view('templates\homepage');
    // }

    public function showHomepage()
    {
        
        if(Auth::user()->userAs == 1){
            $tanis      = TaniModel::where('idMerchant',Auth::user()->id)->get();
            $ternaks    = TernakModel::where('idMerchant',Auth::user()->id)->get();
            $wisatas    = WisataModel::where('idMerchant',Auth::user()->id)->get();
            $villas     = VillaModel::where('idMerchant',Auth::user()->id)->get();
            $edukasis   = EdukasiModel::where('idMerchant',Auth::user()->id)->get();
            return view ('seller/sellerHome', compact('tanis','ternaks','wisatas','villas','edukasis'));
            // return view ('seller/sellerHome', compact('ternaks'));
        }elseif(Auth::user()->userAs == 0){
            return view('templates\homepage');
        }

    }
}
