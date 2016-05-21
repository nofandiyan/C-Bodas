<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 0){
            // $tanis      = TaniModel::where('idMerchant',Auth::user()->id)->get();
            // $ternaks    = TernakModel::where('idMerchant',Auth::user()->id)->get();
            // $wisatas    = WisataModel::where('idMerchant',Auth::user()->id)->get();
            // $villas     = VillaModel::where('idMerchant',Auth::user()->id)->get();
            // $edukasis   = EdukasiModel::where('idMerchant',Auth::user()->id)->get();
            // return view ('seller/sellerHome', compact('tanis','ternaks','wisatas','villas','edukasis'));
            return view ('admin.adminHome');
        }elseif(Auth::user()->role == 1){
            return view ('seller.sellerHome');
        }elseif(Auth::user()->role == 2){
            return view ('customer.customerHome');
        }
    }
}
