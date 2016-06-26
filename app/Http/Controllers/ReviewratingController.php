<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\Reservation;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;




class ReviewratingController extends Controller
{
	 public function __construct(){

        $this->middleware('auth');
    }
	function showreviewrating(){
	$customer = DB::table('customers')->where('id', Auth::user()->id)->value('id');
	$cart= DB::table('detail_reservations')
	->join('detail_products','detail_reservations.detail_product_id','=','detail_products.id')
	->join('reservations','detail_reservations.reservation_id','=','reservations.id')
	->join('prices_products','detail_reservations.price_id','=','prices_products.id')
	->join('products','detail_products.product_id','=','products.id')
	->select('reservations.customer_id','detail_products.id as detailproductid','products.name','prices_products.price')
	->where('reservations.customer_id','=',$customer)

	->first();

	$cart->images = DB::table('images_products')
    ->where('detail_product_id', '=', $cart->detailproductid)
    ->get();
	

    return view('templates.reviewrating',compact('cart','images'));
	}

	function insertreviewrating(){
	$customer = DB::table('customers')->where('id', Auth::user()->id)->value('id');
	$cart= DB::table('reviews')
                       ->insert([
                        'customer_id'   		=> auth()->user()->id,
                        'detail_product_id'     => Input::get('detail_product_id'),
                        'rating'          		=> Input::get('rating'),
                        'created_at'    		=> Carbon::now()    
                        ]);

    return view('templates.reviewratingberhasil');
	}
	
}	