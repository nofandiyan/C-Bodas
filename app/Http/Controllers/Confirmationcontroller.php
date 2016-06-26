<?php

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

class ConfirmationController extends Controller
{

    public function __construct(){

        $this->middleware('auth');
    }

    public function showconfirmation(){

           
    	return view('templates.konfirmasipembayaran');
    }

    public function paymentConfirmation(Request $request){

    		$this->validate($request, [
            	'image'         => 'required|mimes:jpeg,png|max:1000',
        	]);


    		$customer = DB::table('customers')->where('id', Auth::user()->id)->value('id'); 
    		$reservation= DB::table('reservations')
			->join('customers','reservations.customer_id', '=', 'customers.id')
			->select('customers.id','payment_proof','reservations.created_at','reservations.id as res_id')
			->where('customers.id', '=' , $customer )
			->where('status', '=', 0)
			->orderby ('created_at', 'DESC')
			->first();

		
			//$id= $request->input('id_reservation');
			$id=$reservation->res_id;
			$name=time();
			$image = $request->file('image');
			$destinationPath = public_path().'/images/payment/';
			$path = $destinationPath.$name.".jpg";
			$url = 'images/payment/'.$name.".jpg";
			// $decoded = base64_decode($image);

			$model=DB::table('reservations')
			->where('id', $id)
			->update([
				'payment_proof' => $url,
				'status' => 1
				]);
			if($model==1){
				$image->move($destinationPath, $name. '.jpg');
				// file_put_contents($path, $decoded);
				$response['Response']=true;	
			}else{
				$response['Response']=false;
			}
				

			return view('templates.buktipembayaranupdated', compact('response'));
		
	}
}	