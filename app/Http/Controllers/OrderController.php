<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input as Input;

use Carbon\Carbon;

class OrderController extends Controller
{
    public function orderPending($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','0')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId')
            ->get();

        $totPriceSeller = 0;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSeller += $prod->countPrice;

        }
        return view ('order.viewOrderPending', compact('products','order','productSeller','totPriceSeller'));
    }

    public function orderAdminShipping($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productAdminShipping = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','3')
            // ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at')
            ->get();

        $totPriceAdminShipping = 0;
        foreach ($productAdminShipping as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceAdminShipping += $prod->countPrice;

        }


        return view ('order.viewOrderAdminShipping', compact('order','productAdminShipping','totPriceAdminShipping'));
        
    }

    public function orderAccepted($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId','carts.updated_at')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productSellerAccepted = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','1')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at')
            ->get();

        $totPriceSellerAccepted = 0;
        foreach ($productSellerAccepted as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
               'detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerAccepted += $prod->countPrice;

        }
        return view ('order.viewOrderAccepted', compact('products','order','productSellerAccepted','totPriceSellerAccepted'));
        
    }

    public function orderRejected($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productSellerRejected = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','2')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at')
            ->get();

        $totPriceSellerRejected = 0;
        foreach ($productSellerRejected as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerRejected += $prod->countPrice;

        }
        return view ('order.viewOrderRejected', compact('products','order','productSellerRejected','totPriceSellerRejected'));
        
    }

    public function orderShipping($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productSellerShipping = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','3')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at')
            ->get();

        $totPriceSellerShipping = 0;
        foreach ($productSellerShipping as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerShipping += $prod->countPrice;

        }
        return view ('order.viewOrderShipping', compact('products','order','productSellerShipping','totPriceSellerShipping'));
        
    }

    public function orderAdmin($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }   

        $products = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->where('reservations.status','=',1)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status as resvStatus','reservations.id as resvId','reservations.payment_proof','carts.amount', 'carts.delivery_cost', 'carts.detail_product_id as detId')
            ->get();

        $totPriceAdmin = 0;
        foreach ($products as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->join('carts','carts.detail_product_id','=','carts.detail_product_id')
            ->where('detail_products.id','=', $prod->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id','carts.status as cartStatus')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));
            $totPriceAdmin += $prod->countPrice;
        }
        return view ('order.viewOrderAdmin', compact('products','order','totPriceAdmin'));
    }

    public function orderValid($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }   

        $products = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->where('reservations.status','=',2)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status as resvStatus','reservations.id as resvId','reservations.payment_proof','carts.amount', 'carts.delivery_cost', 'carts.detail_product_id as detId')
            ->get();

        $totPriceAdmin = 0;
        foreach ($products as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->join('carts','carts.detail_product_id','=','carts.detail_product_id')
            ->where('detail_products.id','=', $prod->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id','carts.status as cartStatus')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));
            $totPriceAdmin += $prod->countPrice;
        }
        return view ('order.viewValid', compact('products','order','totPriceAdmin'));
    }

    public function orderInvalid($resvId)
    {
        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$resvId)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }   

        $products = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$resvId)
            ->where('reservations.status','=',3)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status as resvStatus','reservations.id as resvId','reservations.payment_proof','carts.amount', 'carts.delivery_cost', 'carts.detail_product_id as detId')
            ->get();

        $totPriceAdmin = 0;
        foreach ($products as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->join('carts','carts.detail_product_id','=','carts.detail_product_id')
            ->where('detail_products.id','=', $prod->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id','carts.status as cartStatus')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detId)
            ->where('carts.reservation_id','=',$resvId)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));
            $totPriceAdmin += $prod->countPrice;
        }
        return view ('order.viewInvalid', compact('products','order','totPriceAdmin'));
    }

    public function show($id)
    {

        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$id)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$id)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }           

        return view ('order.viewOrder', compact('products','order','productSeller','totPriceAdmin','totPriceSeller','productSellerAccepted','productSellerRejected','productSellerShipping','productSellerShipped','totPriceSellerAccepted','totPriceSellerRejected','totPriceSellerShipping','totPriceSellerShipped'));
    }

    public function valid($id)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('reservations')

            ->where('id','=', $id)
            ->update([
                'status'      => 2,
                'updated_at'   => $now
                ]);

            return redirect('/');
    }

    public function invalid($id)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('reservations')
            ->where('id','=', $id)
            ->update([
                'status'      => 3,
                'updated_at'   => $now
                ]);

        return redirect('/');
    }

    public function accepted($resvId, $detId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('carts')

            ->where('reservation_id','=', $resvId)
            ->where('detail_product_id','=', $detId)
            ->update([
                'status'      => 1,
                'updated_at'=>$now
                ]);

            return redirect('/');
    }

    public function rejected($resvId, $detId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('carts')

            ->where('reservation_id','=', $resvId)
            ->where('detail_product_id','=', $detId)
            ->update([
                'status'      => 2,
                'updated_at'=>$now
                ]);

            return redirect('/');
    }

    public function shipping(Request $request, $resvId, $detId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        $this->validate($request, [
            'resi'          => 'required'
        ]);

        $shipping = DB::table('carts')
            ->where('reservation_id','=',$resvId)
            ->where('detail_product_id','=',$detId)
            ->update([
                'status'    => 3,
                'resi'      => Input::get('resi'),
                'updated_at'=>$now
                ]);

        return redirect('/');
    }
}
