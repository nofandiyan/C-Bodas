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

use Mail;

class OrderController extends Controller
{
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
            ->join('products','products.id','=','detail_products.product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId',
                'products.category_id')
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
            ->where('reservations.status','=','1')
            
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.schedule')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderAdmin', compact('products','order','productSeller','totPriceSeller','countPrice'));
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('reservations.status','=','2')
            
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.schedule')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewValid', compact('products','order','productSeller','totPriceSeller','countPrice'));
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('reservations.status','=','3')
            
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.schedule')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewInvalid', compact('products','order','productSeller','totPriceSeller','countPrice'));
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','3')
            
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.schedule','carts.updated_at')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderAdminShipping', compact('products','order','productSeller','totPriceSeller','countPrice'));
        
    }

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
            ->join('products','detail_products.product_id','=','products.id')
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

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderPending', compact('products','order','productSeller','totPriceSeller','countPrice'));
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','1')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }   
        
        
        return view ('order.viewOrderAccepted', compact('products','order','productSeller','totPriceSeller','countPrice'));
        
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','2')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }   
        
        
        return view ('order.viewOrderRejected', compact('products','order','productSeller','totPriceSeller','countPrice'));
        
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

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','3')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }   
        
        
        return view ('order.viewOrderShipping', compact('products','order','productSeller','totPriceSeller','countPrice'));
        
    }

    public function orderShipped($resvId)
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

        $productAdmin = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','4')
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule')
            ->get();

        $sumPriceAdmin = 0;
        $totPriceAdmin = 0;
        $i=1;
        foreach ($productAdmin as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPriceAdmin[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPriceAdmin[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceAdmin += $countPriceAdmin[$i];
            $i++;
        }   

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('carts.status','=','4')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule')
            ->get();

        $sumPriceSeller = 0;
        $totPriceSeller = 0;
        $i=1;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==2) {
                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw($prod->sumPrice*0.05));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                    'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;

            }elseif($prod->detProd->category_id==1 || $prod->detProd->category_id==3){

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
            }

            $totPriceSeller += $countPrice[$i];
            $i++;
        }   
        
        
        return view ('order.viewOrderShipped', compact('products','order','productSeller','totPriceSeller','countPrice','productAdmin','totPriceAdmin','countPriceAdmin'));
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

    public function valid($resvId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('reservations')
            ->where('id','=', $resvId)
            ->update([
                'status'      => 2,
                'updated_at'   => $now
                ]);

        DB::table('carts')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('carts.reservation_id','=', $resvId)
            ->where('products.category_id','=', 3)
            ->update([
                'carts.status'          => 4,
                'carts.updated_at'      => $now
                ]);

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
            
            $data = [
                    'resvId'        => $resvId,
                    'totPrice'      => $ord->totPrice,
                    'dateOrder'     => $ord->cust->created_at,
                    'status'        => "Valid",
                    'custId'        => $ord->cust->customer_id,
                    'custMail'      => $ord->cust->email,
                    'custPhone'     => $ord->cust->phone,
                    'custName'      => $ord->cust->name,
                    'custStreet'    => $ord->cust->street,
                    'custCityType'  => $ord->city->type,
                    'custCity'      => $ord->city->city,
                    'custProv'      => $ord->prov->province,
                    'custZip'       => $ord->cust->zip_code,
                    'sendName'      => $ord->deliv->name,
                    'sendPhone'     => $ord->deliv->phone,
                    'sendStreet'    => $ord->deliv->street,
                    'sendCityType'  => $ord->deliv->type,
                    'sendCity'      => $ord->deliv->city,
                    'sendProv'      => $ord->deliv->province,
                    'sendZip'       => $ord->deliv->zip_code,
                    'products'      => $products
                    ];

            Mail::queue('email.orderValid', $data, function ($m) use ($ord){
                $m->from('noreply@c-bodas.com', 'C-Bodas');

                $m->to($ord->cust->email)->subject('Order Valid');
            });
        }

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

    public function shippingTernak($resvId, $detId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

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

    Public function shipped($resvId, $detId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        $cartsShipped = DB::table('carts')
            ->where('reservation_id','=',$resvId)
            ->where('detail_product_id','=',$detId)
            ->update([
                'status'    => 4,
                'updated_at'=>$now
                ]);

        return redirect('/');
    }
}
