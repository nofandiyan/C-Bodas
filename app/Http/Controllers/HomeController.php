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
                ->join('users', 'sellers.id', '=', 'users.id')
                ->select('sellers.id', 'sellers.id', 'users.name', 'users.role')
                ->get();

            $customers = DB::table('customers')
                ->join('users', 'customers.id', '=', 'users.id')
                ->select('customers.id', 'customers.id', 'users.name', 'users.role')
                ->get();

//OrderPending
            $orders = DB::table('carts')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->select(DB::raw('DISTINCT(carts.reservation_id)'))
                ->where('reservations.status','=','1')
                ->get();
            
            foreach ($orders as $ord) {

            $ord->resv = DB::table('reservations')
            ->join('users','reservations.customer_id','=','users.id')
            ->where('reservations.id','=',$ord->reservation_id)
            ->select('reservations.id','reservations.customer_id','reservations.status','reservations.created_at','users.name')
            ->first();

             $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$ord->reservation_id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            }

//orderValid
            $orderValid = DB::table('carts')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->select(DB::raw('DISTINCT(carts.reservation_id)'))
                ->where('reservations.status','=','2')
                ->get();
            
            foreach ($orderValid as $ord) {
            $ord->resv = DB::table('reservations')
            ->join('users','reservations.customer_id','=','users.id')
            ->where('reservations.id','=',$ord->reservation_id)
            ->select('reservations.id','reservations.customer_id','reservations.status','reservations.created_at','users.name')
            ->first();

             $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$ord->reservation_id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            }

//orderInvalid
            $orderInvalid = DB::table('carts')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->select(DB::raw('DISTINCT(carts.reservation_id)'))
                ->where('reservations.status','=','3')
                ->get();
            
            foreach ($orderInvalid as $ord) {

            $ord->resv = DB::table('reservations')
            ->join('users','reservations.customer_id','=','users.id')
            ->where('reservations.id','=',$ord->reservation_id)
            ->select('reservations.id','reservations.customer_id','reservations.status','reservations.created_at','users.name')
            ->first();

             $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$ord->reservation_id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            }

//Shipping
            $orderAdminShipping = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.status','=','2')
            ->where('carts.status','=','3')
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

            foreach ($orderAdminShipping as $prodShip) {

                $prodShip->prod = DB::table('detail_products')
                ->join('carts','carts.detail_product_id','=','detail_products.id')
                ->join('sellers','detail_products.seller_id','=','sellers.id')
                ->where('carts.reservation_id','=',$prodShip->reservation_id)
                
                ->select('carts.updated_at')
                ->first();

                $prodShip->cust = DB::table('reservations')
                ->join('users','reservations.customer_id','=','users.id')
                ->select('users.name as custName','users.id as custId')
                ->first();
            }


//orderClosed
            $orderClosed = DB::table('carts')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->select(DB::raw('DISTINCT(carts.reservation_id)'))
                ->where('reservations.status','=','4')
                ->get();
            
            foreach ($orderClosed as $ord) {

            $ord->resv = DB::table('reservations')
            ->join('users','reservations.customer_id','=','users.id')
            ->where('reservations.id','=',$ord->reservation_id)
            ->select('reservations.id','reservations.customer_id','reservations.status','reservations.created_at','users.name')
            ->first();

             $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$ord->reservation_id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            }

            return view ('admin.adminHome', compact('profiles', 'category','products','sellers', 'customers','orders','orderValid','orderInvalid','orderClosed','orderAdminShipping'));

        }elseif(Auth::user()->role == "seller"){
            $profile = DB::table('users')
                ->join('sellers', 'users.id', '=', 'sellers.id')
                ->where('users.id','=', Auth::user()->id)
                ->select('users.id', 'sellers.prof_pic', 'users.name', 'users.phone', 'users.email')
            ->first();

            $products = DB::table('products')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('detail_products', 'products.id', '=', 'detail_products.product_id')
            ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
            ->where('sellers.id', '=', Auth::user()->id)
            ->select('detail_products.id as id', 'products.name', 'detail_products.description', 'products.category_id','sellers.id as sellerId')
            ->get();

//pending
            $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->where('reservations.status','=','2')
            ->where('carts.status','=','0')
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

            foreach ($productSeller as $prod) {

                $prod->detProd = DB::table('detail_products')
                ->join('carts','carts.detail_product_id','=','detail_products.id')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->join('products','products.id','=','detail_products.product_id')
                ->join('sellers','detail_products.seller_id','=','sellers.id')
                ->where('carts.reservation_id','=',$prod->reservation_id)
                ->select(
                    'reservations.created_at',
                    'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                    'products.name', 'products.category_id',
                    'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
                ->first();

                $prod->cust = DB::table('reservations')
                ->join('users','reservations.customer_id','=','users.id')
                ->select('users.name as custName','users.id as custId')
                ->first();
            }

//accept
            $productSellerAccepted = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->where('reservations.status','=','2')
            ->where('carts.status','=','1')
            ->get();


            foreach ($productSellerAccepted as $prod) {

                $prod->detProd = DB::table('detail_products')
                ->join('carts','carts.detail_product_id','=','detail_products.id')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->join('products','products.id','=','detail_products.product_id')
                ->join('sellers','detail_products.seller_id','=','sellers.id')
                ->where('carts.reservation_id','=',$prod->reservation_id)
                ->select(
                    'reservations.created_at',
                    'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                    'products.name', 'products.category_id',
                    'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
                ->first();

                $prod->cust = DB::table('reservations')
                ->join('users','reservations.customer_id','=','users.id')
                ->select('users.name as custName','users.id as custId')
                ->first();
                
            }

//rejected
            $productSellerRejected = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->where('reservations.status','=','2')
            ->where('carts.status','=','2')
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

            foreach ($productSellerRejected as $prod) {

                $prod->detProd = DB::table('detail_products')
                ->join('carts','carts.detail_product_id','=','detail_products.id')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->join('products','products.id','=','detail_products.product_id')
                ->join('sellers','detail_products.seller_id','=','sellers.id')
                ->where('carts.reservation_id','=',$prod->reservation_id)
                ->select(
                    'reservations.created_at',
                    'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                    'products.name', 'products.category_id',
                    'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
                ->first();

                $prod->cust = DB::table('reservations')
                ->join('users','reservations.customer_id','=','users.id')
                ->select('users.name as custName','users.id as custId')
                ->first();
                
            }

//shipping
            
            $productSellerShipping = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->where('reservations.status','=','2')
            ->where('carts.status','=','3')
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

            foreach ($productSellerShipping as $prod) {

                $prod->detProd = DB::table('detail_products')
                ->join('carts','carts.detail_product_id','=','detail_products.id')
                ->join('reservations','reservations.id','=','carts.reservation_id')
                ->join('products','products.id','=','detail_products.product_id')
                ->join('sellers','detail_products.seller_id','=','sellers.id')
                ->where('carts.reservation_id','=',$prod->reservation_id)
                ->select(
                    'reservations.created_at',
                    'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                    'products.name', 'products.category_id',
                    'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
                ->first();

                $prod->cust = DB::table('reservations')
                ->join('users','reservations.customer_id','=','users.id')
                ->select('users.name as custName','users.id as custId')
                ->first();
                
            }

            return view ('seller.sellerHome', compact('profile','products','orders','productSeller','productSellerAccepted','productSellerRejected','productSellerShipping'));
            
        }elseif(Auth::user()->role == "customer"){
            $profiles   = DB::table('users')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.id')
                     ->where('customers.id', '=', Auth::user()->id);
            })
            ->get();
            return view ('templates\homepage');
        }
    }
}
