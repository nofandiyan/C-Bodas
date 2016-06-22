<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use PushNotification; 
trait Notification{
	public function sendNotification($message){
		// $deviceToken = 'csSX0uIDzaY:APA91bFibhimymgb_GMIl6uF-y3u7PzNIohnYkPMiAHxqlG8bfz3ud5PUbjVjjP7wfXCNk7avnXe7MnSatFVZB9C7ZMoDzYMakt-V45lW8vgCvQI8dbnWETPiXhRYSkch6L-jQATnEDP';

		// $message = '21-We have successfully sent a push notification!';
		$pieces = explode('-', $message);
		$model = DB::table('reservations')
		->join('customers', 'reservations.customer_id', '=', 'customers.id')
		->select('device_token')
		->where('reservations.id', $pieces[0])
		->first();
		// var_dump($model);
		if(isset($model->device_token)){
	        $collection = PushNotification::app('appNameAndroid')
	        ->to($model->device_token);
	        $collection->adapter->setAdapterParameters(['sslverifypeer' => false]);
	        $collection->send($message);
	        // var_dump($collection);
		}
	}


}