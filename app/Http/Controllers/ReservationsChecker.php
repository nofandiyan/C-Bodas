<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use PushNotification;
use Carbon\Carbon;
trait ReservationsChecker{
	// use Notification;
	public function reservationsExpired(){
		// $dt = Carbon::now();
		$models = DB::table('reservations')
	    ->whereIn('status',['0','3'])
	    ->where('created_at','<', Carbon::now()->subHours(3))
	    ->get();
	    foreach ($models as $model) {
	    	# code...
	    	$message = $model->id.'-'.'Pesanan Nomor'.$model->id.' telah dihapus';
	    	$this->sendNotification($message);
	    	DB::table('reservations')->where('id', $model->id)->delete();
	    }
	    // var_dump($model);
	    // return $models;
	}

	public function expReservationsNotification(){
		$models = DB::table('reservations')
		->whereIn('status',['0','3'])
	    ->where('created_at','=', Carbon::now()->subMinutes(6))
	    ->get();
	    foreach ($models as $model) {
	    	# code...
	    	$message = $model->id.'-'.'Segera Konfirmasi Pembayaran Anda.';
	    	$this->sendNotification($message);
	    	// DB::table('reservations')->where('id', $model->id)->delete();
	    }
	}

	// public function
}