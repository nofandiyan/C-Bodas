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
            $profiles = User::where('id', Auth::user()->id)->first();
            $category = DB::table('category_products')->get();
            
            $products = DB::table('products')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
            ->select('detail_products.id','products.name', 'products.category_id', 'detail_products.description', 'detail_products.seller_id')
            ->get();

            $sellers = DB::table('sellers')
                ->join('users', 'sellers.user_id', '=', 'users.id')
                ->select('sellers.user_id', 'sellers.id', 'users.name', 'users.role')
                ->get();

            $customers = DB::table('customers')
                ->join('users', 'customers.user_id', '=', 'users.id')
                ->select('customers.user_id', 'customers.id', 'users.name', 'users.role')
                ->get();            

            return view ('admin.adminHome', compact('profiles', 'category','products','sellers', 'customers'));

        }elseif(Auth::user()->role == "seller"){
            $profile = DB::table('users')
                ->join('sellers', 'users.id', '=', 'sellers.user_id')
                ->where('users.id','=', Auth::user()->id)
                ->select('users.id', 'sellers.prof_pic', 'users.name', 'users.phone', 'users.email')
            ->first();

            $products = DB::table('products')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
            ->where('sellers.user_id', '=', Auth::user()->id)
            ->select('detail_products.id', 'products.name', 'detail_products.description', 'products.category_id','sellers.user_id')
            ->get();

            $orders = DB::table('carts')
                ->join('reservations', 'reservations.id','=','carts.reservation_id')
                ->join('detail_products', 'detail_products.id','=','carts.detail_product_id')
                ->join('products', 'detail_products.product_id','=','products.id')
                ->join('category_products', 'category_products.id','=','products.category_id')
                ->join('sellers', 'detail_products.seller_id' ,'=','sellers.id')
                ->where('sellers.user_id','=',Auth::user()->id)
                ->select('carts.reservation_id','carts.detail_product_id', 'products.name', 'category_products.category_name', 'carts.status','carts.created_at')
                ->orderBy('carts.reservation_id', 'asc')
                ->get();

            return view ('seller.sellerHome', compact('profile','products','orders'));
            
        }elseif(Auth::user()->role == "customer"){
            $profiles   = DB::table('users')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.user_id')
                     ->where('customers.user_id', '=', Auth::user()->id);
            })
            ->get();
            // return view ('customer.customerHome', compact('profiles'));
            return view ('templates\homepage');
        }
    }
}
