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
		$auth = auth()->guard('api');
		if (!$auth->check()){
			return response('Unauthorized.', 401);
		}else{
			$dt = Carbon::now();
			$dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
			$now = $dt->toDateTimeString();
			// echo $mytime->toDateTimeString();
			$Reservation = new Reservation;
			$Reservation->customer_id = $request->input('id_customer');
			$Reservation->delivery_id = $request->input('id_delivery');
			$Reservation->bank_name = $request->input('bank_name');
			$Reservation->bank_account = $request->input('bank_account');
			$Reservation->created_at = $now;
			$Reservation->updated_at = $now;
			
			$id = DB::table('reservations')->insertGetId(
	        ['customer_id' => $Reservation->customer_id, 'bank_name' => $Reservation->bank_name, 'bank_account' => $Reservation->bank_account,
	        'delivery_id' => $Reservation->delivery_id, 'created_at' => $Reservation->created_at, 'updated_at' => $Reservation->updated_at]
	        );     
			
			$products = count($request->input('products'));
			for($x=0; $x < $products; $x++){
				DB::table('carts')->insert([
					'reservation_id' => $id, 'detail_product_id' => $request->input('products.'.$x.'.id_detail_product'), 
					'delivery_cost' => $request->input('products.'.$x.'.delivery_cost'), 'price_id' => $request->input('products.'.$x.'.id_price'), 
					'amount' => $request->input('products.'.$x.'.amount'), 'schedule' => $request->input('products.'.$x.'.schedule')
					]);
			}
			$response['Response']=true;
			return $response;
		}

	}

	public function getReservation(Request $request){
		$auth = auth()->guard('api');
		if (!$auth->check()){
			return response('Unauthorized.', 401);
		}else{
			 $id_customer=$request->input('id_customer');
			 $models = DB::table('reservations')
			 ->select('reservations.id as id_reservation', 'reservations.customer_id as id_customer', 
			 	'reservations.delivery_id as id_delivery', 
			 	'status', 'bank_name', 'bank_account', 'reservations.created_at')
			 ->where('reservations.customer_id', $id_customer)
			 ->orderBy('created_at', 'desc')
			 ->get();


			 return $models;
		}
	}

	public function getDetailReservation(Request $request){
		$auth = auth()->guard('api');
		if (!$auth->check()){
			return response('Unauthorized.', 401);
		}else{
			 $idReservation=$request->input('id_reservation');
			 $models = DB::table('reservations')
			 ->join('delivery_address', 'reservations.delivery_id', '=', 'delivery_address.id')
			 ->join('cities', 'delivery_address.city_id', '=', 'cities.id')
			 ->join('provinces', 'cities.province_id', '=', 'provinces.id')
			 ->select('reservations.id as id_reservation', 'reservations.customer_id as id_customer', 
			 	'reservations.delivery_id as id_delivery', 'delivery_address.name as recipient_name', 'delivery_address.street',
			 	'delivery_address.zip_code', 'delivery_address.phone', 'cities.type', 'cities.city', 'provinces.province',
			 	'status', 'bank_name', 'bank_account', 'reservations.created_at', 'payment_proof')
			 ->where('reservations.id', $idReservation)
			 ->orderBy('created_at', 'desc')
			 ->get();

			 foreach ($models as $model) {
			 	$model->carts= DB::table('carts')
			 	->join('prices_products', 'carts.price_id', '=', 'prices_products.id')
			 	->select('carts.detail_product_id as ID_DETAIL_PRODUCT', 'price_id as ID_PRICE', 'prices_products.PRICE',
			 		'AMOUNT', 'SCHEDULE' ,'DELIVERY_COST', 'STATUS')
			 	->where('reservation_id', $model->id_reservation)
			 	// ->where('prices_products.id', $object->ID_PRICE)
			 	->get();
			 		foreach ($model->carts as $key => $object ) {
					 	$tmps = DB::table('detail_products')
					 	->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
					 	->join('users', 'sellers.id', '=', 'users.id')
			        	->join('products', 'detail_products.product_id', '=', 'products.id')
			        	->join('category_products', 'products.category_id', '=', 'category_products.id')
					 	->select('products.name as product_name', 'detail_products.rating', 'detail_products.stock',
					 		'category_products.category_name', 'users.name as seller_name', 'detail_products.updated_at'
					 		)
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
	}

	public function paymentConfirmation(Request $request){
		$auth = auth()->guard('api');
		if (!$auth->check()){
			return response('Unauthorized.', 401);
		}else{
			$id= $request->input('id_reservation');
			$name = $request->input('name');
			$image = $request->input('image');
			$destinationPath = public_path().'/images/payment/';
			$path = $destinationPath.$name.".jpg";
			$url = 'images/payment/'.$name.".jpg";
			$decoded = base64_decode($image);

			$model=DB::table('reservations')
			->where('id', $id)
			->update([
				'payment_proof' => $url,
				'status' => 1
				]);
			if($model==1){
				file_put_contents($path, $decoded);
				// $decoded->move($path, $)
				$response['Response']=true;	
			}else{
				$response['Response']=false;
			}		
			return $response;
		}
	}

}
