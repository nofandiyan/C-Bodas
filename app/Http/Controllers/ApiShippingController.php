<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Auth;

class ApiShippingController extends Controller
{
	public function __construct(){

		$this->middleware('auth');
	}

	public function construct(){

	}
	public function showProvince(){

	}

	public function hitungongkir(Request $request){
		
		$cart=$request->session()->get('$datacart');
		$weight=0;
		foreach($cart as $c){
			if($c['category_id']==1)
				$weight+=$c['jumlah'];
		}
		
		$customer = DB::table('customers')->where('id', Auth::user()->id)->value('id');
		$destination= DB::table('delivery_address')
		->join('customers','delivery_address.customer_id', '=', 'customers.id')
		->join('cities','delivery_address.city_id','=','cities.id')
		->select('customers.id','cities.province_id','cities.id as city_id','delivery_address.created_at')
		->where('customers.id', '=' , $customer )
		->orderby ('created_at', 'DESC')
		->first();
		

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=24&destination= $destination->city_id &weight=$weight&courier=pos",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: cf2bcde1967e60ec66bd849c68a19e2a"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);

		// echo "<pre>";
		// var_dump($response);
		// die();

		$data = json_decode($response);
		//dd($data->rajaongkir->results[0]->costs);
		return view ('templates.checkout-shipping', ['services' => $data->rajaongkir->results[0]->costs],['weight'=>$weight]);
	}

	public function pilihongkir(Request $request){
		$post=$request->all();

		$v=\Validator::make($request->all(),
			['data'=>'required']);                

		$request->session()->put('$ongkir',array(
			'harga_ongkir'=>$post['data']
			)
		);
	
       /* $cart=$take;*/
		return view('templates.checkout-payment',compact('hargaongkir'));
	}
	
	public function reviewpemesanan(Request $request){
		$post=$request->all();
		$hargaongkir=$request->session()->get('$ongkir'); 
		$customer = DB::table('customers')->where('id', Auth::user()->id)->value('id'); 

		$request->session()->put('$databank',array(
			'bank_name'=>$post['Bank'],
			'bank_account'=>$post['bankaccount']
			)
		);

		$bank=$request->session()->get('$databank');
		
		$destination= DB::table('delivery_address')
		->join('customers','delivery_address.customer_id', '=', 'customers.id')
		->join('cities','delivery_address.city_id','=','cities.id')
		->join('provinces','cities.province_id','=','provinces.id')
		->select('customers.id','cities.province_id','cities.id as city_id','delivery_address.created_at','cities.city','provinces.province','delivery_address.street','delivery_address.zip_code')
		->where('customers.id', '=' , $customer )
		->orderby ('created_at', 'DESC')
		->first();


        $cart=$request->session()->get('$datacart');
        $jumlah=0;
        $amount=0;
        foreach ($cart as $c) {
      
        	$harga=$c['price'];
        	$jumlah=$c['jumlah'];
        	$amount+=$c['jumlah'];
        }
       
        return view('templates.checkout-review',compact('hargaongkir','destination','jumlah','cart','amount','bank'));
	}

	public function reviewProduct(Request $request){
        $auth = auth()->guard('api'); 
        if (!$auth->check()){
            return response('Unauthorized.', 401);
        }else{  
            $id_customer = $request->input('id_customer');
            $id_detail = $request->input('id_detail');
            $rating = $request->input('rating');
            $review = $request->input('review');

            $model = DB::table('reservations')
            ->join('detail_reservations', 'detail_reservations.reservation_id', '=', 'reservations.id')
            ->select(DB::raw('DISTINCT(detail_reservations.detail_product_id) as id_detail_product'))
            ->where('reservations.customer_id', $id_customer)
            ->where('detail_reservations.detail_product_id', $id_detail)
            ->where('reservations.status', '2')
            ->get();

            if(count($model)==1){
                DB::table('reviews')->insert([
                    'customer_id' => $id_customer, 'detail_product_id' => $id_detail,
                    'rating' => $rating, 'review' => $review
                    ]);
                $response['Response'] =true;
                return $response;
            }else{
                $response['Response'] =false;
                return $response;
            }
            
        }
    }
}