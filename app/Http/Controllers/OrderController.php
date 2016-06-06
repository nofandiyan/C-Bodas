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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function index($id)
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = DB::table('prices_products')
            ->orderBy('id', 'desc')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$id)
            ->select('prices_products.price')
            ->first();

        $orders = DB::table('carts')
            ->where('detail_products.id', '=', $id)
            ->join('reservations', 'reservations.id','=','carts.reservation_id')
            ->join('detail_products', 'detail_products.id','=','carts.detail_product_id')
            ->join('products', 'detail_products.product_id','=','products.id')
            ->join('category_products', 'category_products.id','=','products.category_id')
            ->join('customers', 'reservations.customer_id' ,'=','customers.id')
            ->join('users', 'users.id' ,'=','customers.id')
            ->select('carts.reservation_id','carts.detail_product_id', 'carts.schedule', 'products.name as product_name', 'category_products.category_name', 'products.category_id', 'carts.amount','users.name as user_name', 'customers.id as customer_id', 'users.street', 'users.city', 'users.province', 'users.zip_code', 'users.phone')
            ->first();

        return view ('order.viewOrder', compact('orders','price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
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
