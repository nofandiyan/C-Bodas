<?php
namespace App\Http\Controllers;

use DB;
use Mail;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ApiReservationsController extends Controller{

	public function store(Request $request){
		$dt = Carbon::now();
		$dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
		$now = $dt->toDateTimeString();
		// echo $mytime->toDateTimeString();
		$Reservation = new Reservation;
		$Reservation->customer_id = $request->input('id_customer');
		$Reservation->bank_name = $request->input('bank_name');
		$Reservation->bank_account = $request->input('bank_account');
		$Reservation->created_at = $now;
		$Reservation->updated_at = $now;
		// $Reservation->save();
		$id = DB::table('reservations')->insertGetId(
        ['customer_id' => $Reservation->customer_id, 'bank_name' => $Reservation->bank_name, 'bank_account' => $Reservation->bank_account,
        'created_at' => $Reservation->created_at, 'updated_at' => $Reservation->updated_at]
        );     
		// $id = DB::table('reservations')
		// ->where('id_customer', $Reservation->id_customer)
		// ->where('created_at', $Reservation->created_at)
		// ->value('id_reservation');
		
		$products = count($request->input('products'));
		for($x=0; $x < $products; $x++){
			DB::table('carts')
			->insert(
				['reservation_id' => $id, 'detail_product_id' => $request->input('products.'.$x.'.id_detail_product'), 
				'price_id' => $request->input('products.'.$x.'.id_price'), 'amount' => $request->input('products.'.$x.'.amount'), 
				'schedule' => $request->input('products.'.$x.'.schedule')]
				);
		}
		$response['Response']=true;
		return $response;
	}

	public function getReservation(Request $request){
		 $id_customer=$request->input('id_customer');
		 $models = DB::table('reservations')
		 ->select('id as id_reservation', 'customer_id as id_customer', 'status', 'bank_name', 'bank_account', 'payment_proof', 'created_at')
		 ->where('customer_id', $id_customer)
		 ->orderBy('created_at', 'desc')
		 ->get();

		 foreach ($models as $model) {
		 	$model->carts= DB::table('carts')
		 	->select('detail_product_id as ID_DETAIL_PRODUCT', 'price_id as ID_PRICE', 'AMOUNT', 'SCHEDULE')
		 	->where('reservation_id', $model->id_reservation)
		 	->get();
		 		foreach ($model->carts as $key => $object ) {
				 	$tmps = DB::table('detail_products')
				 	->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
				 	->join('users', 'sellers.user_id', '=', 'users.id')
		        	->join('products', 'detail_products.product_id', '=', 'products.id')
		        	->join('category_products', 'products.category_id', '=', 'category_products.id')
				 	->select('products.name as product_name', 'detail_products.rating', 'detail_products.stock',
				 		'category_products.category_name', 'users.name as seller_name', 'detail_products.updated_at')
				 	->where('detail_products.id', $object->ID_DETAIL_PRODUCT)
				 	->get();
				 	// var_dump($tmps);
					 	foreach ($tmps as $tmp) {
					 		$object->PRODUCT_NAME= $tmp->product_name;
					 		$object->RATING = $tmp->rating;
					 		$object->STOCK = $tmp->stock;
					 		$object->CATEGORY = $tmp->category_name;
					 		$object->SELLER = $tmp->seller_name;
							$object->LINKS=DB::table('images_products')
				            ->select('images_products.link')
				            ->where('images_products.detail_product_id', "=", $object->ID_DETAIL_PRODUCT)
				            ->get();
					 		// $object->LINK = $tmp->link;					 		
					 	}		 	
		 		}
		 }
		 return $models;
	}

	public function paymentConfirmation(Request $request){
		$destinationPath = public_path().'/images/';
		$name = $request->input('name');
		$image = $request->input('image');
		$url = $destinationPath.$name.".jpg";
		$decoded = base64_decode($image);
		file_put_contents($url, $decoded);
		return $url;
	}


}
