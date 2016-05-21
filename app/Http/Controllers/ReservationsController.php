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

class ReservationsController extends Controller{

	public function store(Request $request){
		$dt = Carbon::now();
		$dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
		$now = $dt->toDateTimeString();
		// echo $mytime->toDateTimeString();
		$Reservation = new Reservation;
		$Reservation->id_customer = $request->input('id_customer');
		$Reservation->bank_name = $request->input('bank_name');
		$Reservation->bank_account = $request->input('bank_account');
		$Reservation->created_at = $now;
		$Reservation->updated_at = $now;
		$Reservation->save();
		$id = DB::table('reservations')
		->where('id_customer', $Reservation->id_customer)
		->where('created_at', $Reservation->created_at)
		->value('id_reservation');
		
		$products = count($request->input('products'));
		for($x=0; $x < $products; $x++){
			DB::table('carts')
			->insert(
				['id_reservation' => $id, 'id_detail_product' => $request->input('products.'.$x.'.id_detail_product'), 
				'amount' => $request->input('products.'.$x.'.amount'), 'schedule' => $request->input('products.'.$x.'.schedule')]
				);
		}
		// foreach ($products as $product) {
		// 	DB::table('carts')
		// 	->insert(
		// 		['id_reservation' => $id, 'id_detail_product' => $product->id_detail_product, 
		// 		'amount' => $product->amount, 'schedule' => $product->schedule]
		// 		);
		// }
		$response['Response']=true;
		return $response;
	}

}


		
		
		

