<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\SellerModel;
use App\CustomerModel;
use DB;

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
        if(Auth::user()->role == "admin"){
            $profiles = User::where('id', Auth::user()->id)->get();
            $category = DB::table('category_products')->get();
            // $tanis      = TaniModel::where('idMerchant',Auth::user()->id)->get();
            // $ternaks    = TernakModel::where('idMerchant',Auth::user()->id)->get();
            // $wisatas    = WisataModel::where('idMerchant',Auth::user()->id)->get();
            // $villas     = VillaModel::where('idMerchant',Auth::user()->id)->get();
            // $edukasis   = EdukasiModel::where('idMerchant',Auth::user()->id)->get();
            // return view ('seller/sellerHome', compact('tanis','ternaks','wisatas','villas','edukasis'));
            return view ('admin.adminHome', compact('profiles', 'category'));
        }elseif(Auth::user()->role == "seller"){
            $profiles   = DB::table('users')
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id')
                     ->where('sellers.user_id', '=', Auth::user()->id);
            })
            ->get();

            $lapaks = DB::table('products')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            ->select('products.*', 'category_products.*', 'detail_products.*')
            ->get();

            return view ('seller.sellerHome', compact('profiles','lapaks'));
        }elseif(Auth::user()->role == "customer"){
            $profiles   = DB::table('users')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.user_id')
                     ->where('customers.user_id', '=', Auth::user()->id);
            })
            ->get();
            return view ('customer.customerHome', compact('profiles'));
        }
    }
}
