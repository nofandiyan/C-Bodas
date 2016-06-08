<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status','reservations.payment_proof','reservations.bank_name','reservations.bank_account')
            ->take(1)
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('users')
            ->where('id','=', $ord->customer_id)
            ->select('name','email','phone','city_id','street','zip_code')
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
            ->where('delivery_address.id','=', $ord->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }        

        $products = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status','reservations.payment_proof','carts.amount', 'carts.delivery_cost', 'carts.detail_product_id')
            ->get();

        foreach ($products as $prod) {
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
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $prod->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));
        }
        
        

        // echo "<pre>";
        // var_dump($orders);
        // die();

        return view ('order.viewOrder', compact('products','order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)

    public function invalid($id)
    {
        echo "lalala";
    }

    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
