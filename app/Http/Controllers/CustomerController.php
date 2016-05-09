<?php
namespace App\Http\Controllers;

use DB;
use Mail;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CustomerController extends Controller{


    public function store(Request $request)
    {
        
        $Customer = new Customer;        
        $Customer->email= $request->input('email');
        $Customer->name = $request->input('name');
        $Customer->gender= $request->input('gender');
        $Customer->address= $request->input('address');
        $Customer->zip_code= $request->input('zip_code');
        $Customer->password= $request->input('password');
        $confirmation_code = str_random(30);
        $Customer->confirmation_code=$confirmation_code;
        $auth=Customer::where('email',$Customer->email)
        ->get();
        if(count($auth)>0){
            $auth['Response']= false;
            
        }else{            
            $auth['Response']= true;
            Mail::send('customer.verify', ['Customer' => $Customer], function($message) use ($Customer)
            {
                $message->from('cibodas.store@gmail.com');
                $message->to($Customer->email)->subject('Welcome!');
            });    
            $Customer->save();
            
        }    
        return $auth; 
    }
        
    

    public function confirm($confirmation_code)
    {
        $user = Customer::where('confirmation_code', $confirmation_code)
        ->get();
        if(count($user)>0){
            // return $user;
            DB::table('customers')
            ->where('confirmation_code', $confirmation_code)
            ->update(['status' => 1,'confirmation_code' => 1]);
            
            echo 'Your Account Has Been Verified !';
        }else
        echo 'Confirmation Code Failed';
        // echo $user->email;
        // return $user;
    }

    public function getLogin(Request $request){
        $customer=Customer::where('email', $request->input('email'))
        ->where('password', $request->input('password'))
        ->get();
        return $customer;
    }

    public function updateLogin(Request $request){
        $customer=Customer::where('id_customer', $request->input('id_customer'))
        ->get();
        return $customer;
    }
    

    public function requestLinkPassword(Request $request){
        $check=Customer::where('email', $request->input('email'))
        ->get();
        if(count($check)>0){
            $confirmation_code = str_random(30);
            $Customer = new Customer;        
            $Customer->email= $request->input('email');
            $Customer->confirmation_code=$confirmation_code;
            DB::table('customers')
            ->where('email', $request->input('email'))
            ->update(['confirmation_code' => $confirmation_code]);
            Mail::send('customer.linkpassword', ['Customer' => $Customer], function($message) use ($Customer)
            {
                $message->from('cibodas.store@gmail.com');
                $message->to($Customer->email)->subject('Welcome!');
            });    
            $auth['Response']= true;
        }else
            $auth['Response']= false;
        return $auth;
    }

    public function getLinkPassword($confirmation_code){
        $user = Customer::where('confirmation_code', $confirmation_code)
        ->get();
        if(count($user)>0){
            return view('customer.resetpassword', ['confirmation_code' => $confirmation_code]);
        }else{
            echo 'shitstain';
        }         
    }

    public function reset(Request $request){
        $model = DB::table('customers')
        ->where('confirmation_code', $request->confirmation_code)
        ->update(['password' => $request->password,'confirmation_code' => 1]);
        if($model==1){
            echo 'success';
        }else{
            echo 'failed';
        }
        
    }

    public function updateAddress(Request $request){
        $model = DB::table('customers')
        ->where('id_customer', $request->input('id_customer'))
        ->update(['address' => $request->input('address'), 'zip_code' => $request->input('zip_code')]);
        if($model==1){
            $response['Response']=true;
        }else{
            $response['Response']=false;
        }        
        return $response;
    }
  
}