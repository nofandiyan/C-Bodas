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

use App\Http\Controllers\Notification;
use App\Http\Controllers\ReservationsChecker;

class OrderController extends Controller
{
    use Notification, ReservationsChecker;
    public function __construct()
    {
        $this->middleware('auth');
        $this->reservationsExpired();
        $this->expReservationsNotification();
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
            ->join('products','products.id','=','detail_products.product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;

        }       
        $buyerTransfer = $prices + $priceDeliv;
        
        return view ('order.viewOrderAdmin', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv','buyerTransfer'));
        
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
            ->join('products','products.id','=','detail_products.product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;

        }       
        $buyerTransfer = $prices + $priceDeliv;
        
        return view ('order.viewValid', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv','buyerTransfer'));
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;

        }       
        $buyerTransfer = $prices + $priceDeliv;
        
        return view ('order.viewInvalid', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv','buyerTransfer'));
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderAdminShipping', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
        
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId','products.category_id')
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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
            ->where(function ($query) {
                $query->where('carts.status','=','0')
                      ->orWhere(function($querys){
                        $querys ->where('products.category_id','=',3)
                                ->where('carts.status','=','4');
                      });
            })

            // ->where('carts.status','=','0')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId')
            ->orderBy('cartStatus', 'asc')
            ->get();

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);

                $countPrice[$i] = $prod->sumPrice + $prod->delivPrice;
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;

        }

        foreach ($productSeller as $ps) {
            if ($ps->cartStatus == 4) {
                return redirect ('/');
            }else{
                return view ('order.viewOrderPending', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
            }
        }
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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
            ->where(function ($query) {
                $query->where('carts.status','=','1')
                      ->orWhere('carts.status','=','4');
            })
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id')
            ->orderBy('cartStatus', 'asc')
            ->get();

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;       

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;             

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        foreach ($productSeller as $ps) {
            if ($ps->cartStatus == 4) {
                return redirect ('/');
            }else{
                return view ('order.viewOrderAccepted', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
            }
        }
        
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderRejected', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
        
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        return view ('order.viewOrderShipping', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
        
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productOrder = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule','carts.transfer')
            ->get();

        $totPriceOrder = 0;
        $profitOrder = 0;
        $countProfitOrder = 0;
        $pricesOrder = 0;
        $priceDelivOrder = 0;
        $i=1;
        foreach ($productOrder as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPriceOrder[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPriceOrder[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDelivOrder += $prod->delivPrice;

            $pricesOrder += $prod->sumPrice;

            $countProfitOrder += $prod->profit[$i];

            $totPriceOrder += $countPriceOrder[$i];
            $i++;
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
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule','carts.transfer')
            ->get();

        $totPriceAdmin = 0;
        $totPriceAdmin = 0;
        $profitAdmin = 0;
        $countProfitAdmin = 0;
        $pricesAdmin = 0;
        $priceDelivAdmin = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profitAdmin[$i] = $prod->sumPrice * 0.05;

                $countPriceAdmin[$i] = $prod->sumPrice - $prod->profitAdmin[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profitAdmin[$i] = $prod->sumPrice * 0.05;                

                $countPriceAdmin[$i] = $prod->sumPrice - $prod->profitAdmin[$i] + $prod->delivPrice;    

            }

            $priceDelivAdmin += $prod->delivPrice;

            $pricesAdmin += $prod->sumPrice;

            $countProfitAdmin += $prod->profitAdmin[$i];

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
            // ->where('reservations.status','=','2')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule','carts.transfer')
            ->get();

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];
            $i++;
        }       
        
        // return view ('order.viewOrderAdminShipped', compact('products','order','productSeller','totPriceSeller','countPrice','countProfit','prices','priceDeliv'));
        
        return view ('order.viewOrderShipped', compact('products','order','productOrder','totPriceOrder','countPriceOrder','productSeller','totPriceSeller','countPrice','productAdmin','totPriceAdmin','countProfitOrder','pricesOrder','priceDelivOrder','countPriceAdmin','countProfitAdmin','pricesAdmin','priceDelivAdmin','countProfit','prices','priceDeliv'));
    }

    public function orderClosed($resvId)
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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }

        $productOrder = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule','detail_products.seller_id','carts.transfer')
            ->get();

        $totPriceOrder = 0;
        $profitOrder = 0;
        $countProfitOrder = 0;
        $pricesOrder = 0;
        $priceDelivOrder = 0;
        $sellerTransfer = 0;
        $i=1;
        foreach ($productOrder as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id')
            ->first();

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPriceOrder[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPriceOrder[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            if ($prod->cartStatus == 4) {
                
                $priceDelivOrder += $prod->delivPrice;

                $pricesOrder += $prod->sumPrice;

                $countProfitOrder += $prod->profit[$i];

                $totPriceOrder += $countPriceOrder[$i];        

            }

            $i++;

        }

        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('reservations.id','=',$resvId)
            ->where('reservations.status','=','4')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId','carts.updated_at','products.category_id','carts.schedule','carts.transfer')
            ->get();

        $totPriceSeller = 0;
        $totPrice = 0;
        $profit = 0;
        $countProfit = 0;
        $prices = 0;
        $priceDeliv = 0;
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

            $prod->priceProd = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->select('prices_products.price')
                ->first();

            $prod->sumPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('(carts.amount * prices_products.price)'));

            if ($prod->detProd->category_id==1) {

                $prod->delivPrice = DB::table('prices_products')
                ->join('carts', 'carts.price_id','=', 'prices_products.id')
                ->where('carts.detail_product_id','=',$prod->detProd->detId)
                ->where('carts.reservation_id','=',$resvId)
                ->sum(DB::raw('carts.delivery_cost'));

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                ]);

                $prod->profit[$i] = $prod->sumPrice * 0.05;

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }else{
                
                $prod->delivPrice = 0;

                $prod->setDelivCost = DB::table('carts')
                    ->where('carts.detail_product_id','=',$prod->detProd->detId)
                    ->where('carts.reservation_id','=',$resvId)
                    ->update([
                        'carts.delivery_cost' => $prod->delivPrice
                    ]);
                
                $prod->profit[$i] = $prod->sumPrice * 0.05;                

                $countPrice[$i] = $prod->sumPrice - $prod->profit[$i] + $prod->delivPrice;    

            }

            if ($prod->cartStatus == 4) {

            $priceDeliv += $prod->delivPrice;

            $prices += $prod->sumPrice;

            $countProfit += $prod->profit[$i];

            $totPriceSeller += $countPrice[$i];

            }
            $i++;
        }        
        
        
        return view ('order.viewOrderClosed', compact('products','order'
            ,'productOrder','totPriceOrder','countPriceOrder'
            ,'productSeller','countPrice'
            ,'productAdmin','totPriceOrder','countPriceAdmin','totPriceSeller','countPrice','countProfitOrder','pricesOrder','priceDelivOrder','countProfit','prices','priceDeliv'));
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

        $sold = DB::table('detail_products')
            ->join('carts', 'detail_products.id', '=', 'carts.detail_product_id')
            ->join('products','detail_products.product_id','=','products.id')
            ->where('carts.reservation_id', '=', $resvId)
            ->select('carts.amount','detail_products.stock','products.category_id')
            ->get();

        foreach ($sold as $sol) {

            if ($sol->category_id == 1 || $sol->category_id == 2) {
                $countSold = $sol->stock - $sol->amount;
                $updateStock = DB::table('detail_products')
                ->join('carts', 'detail_products.id', '=', 'carts.detail_product_id')
                ->join('products','detail_products.product_id','=','products.id')
                ->where('carts.reservation_id', '=', $resvId)
                ->where('products.category_id', '=', $sol->category_id)
                ->update([
                    'detail_products.stock' => $countSold
                    ]);
            }
        }

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
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId', 'carts.reservation_id',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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
        $countPrice[] = 0;
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

                // $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;
                $countPrice[$i] = $prod->sumPrice;

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
            
        $data = [
                'order'         => $order,
                'product'       => $productSeller,
                'countPrice'    => $countPrice,
                'totPrice'      => $totPriceSeller
                ];            

            Mail::queue('email.orderValid', $data, function ($m) use ($ord){
                $m->from('noreply@c-bodas.com', 'C-Bodas');

                $m->to($ord->cust->email)->subject('Order Valid');
            });
            $message = $resvId.'-Pembayaran Telah Diterima. Terima Kasih';
            $this->sendNotification($message);
            
        

        return redirect('/');
    }

    public function invalid($resvId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        DB::table('reservations')
            ->where('id','=', $resvId)
            ->update([
                'status'      => 3,
                'updated_at'   => $now
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
            ->join('products','products.id','=','detail_products.product_id')
            ->where('carts.reservation_id','=',$resvId)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId', 'carts.reservation_id',
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
            ->where('delivery_address.id','=', $ord->cust->delivery_id)
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
        $countPrice[] = 0;
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

                // $countPrice[$i] = $prod->sumPrice - $prod->delivPrice;
                $countPrice[$i] = $prod->sumPrice;

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
            
        $data = [
                'order'         => $order,
                'product'       => $productSeller,
                'countPrice'    => $countPrice,
                'totPrice'      => $totPriceSeller
                ];            

            Mail::queue('email.orderInvalid', $data, function ($m) use ($ord){
                $m->from('noreply@c-bodas.com', 'C-Bodas');

                $m->to($ord->cust->email)->subject('Order Invalid');
            });

            $message = $resvId.'-Bukti Pembayaran Tidak Valid';
            $this->sendNotification($message);

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

            return redirect('/OrderPending/'.$resvId);
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

            return redirect('/OrderPending/'.$resvId);
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

    Public function closed($resvId)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        $closed = DB::table('reservations')
            ->where('id','=',$resvId)
            ->update([
                'status'    => 4,
                'updated_at'=>$now
                ]);

        return redirect('/');
    }

    Public function transfer($resvId, $detId)
    {

        $cartsShipped = DB::table('carts')
            ->where('reservation_id','=',$resvId)
            ->where('detail_product_id','=',$detId)
            ->update([
                'transfer'    => 1
                ]);

        return redirect('/OrderShipped/'.$resvId);
    }
}
