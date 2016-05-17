<?php
namespace App\Http\Controllers;

use DB;
use Mail;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiCustomerController extends Controller{


    public function store(Request $request)
    {        
        $Customer = new Customer;        
        $Customer->email= $request->input('EMAIL');
        $Customer->name = $request->input('NAME');
        $Customer->gender= $request->input('GENDER');
        $Customer->street= $request->input('STREET');
        $Customer->city = $request->input('CITY');
        $Customer->province = $request->input('PROVINCE');
        $Customer->zip_code= $request->input('ZIP_CODE');
        $Customer->password= $request->input('PASSWORD');
        $Customer->phone = $request->input('PHONE');
        $Customer->confirmation_code = str_random(30);

        $auth = DB::table('users')
        ->where('email', $Customer->email)
        ->where('role', 'customer')
        ->get();

        if(count($auth)>0){
            $auth['Response']= false;            
        }else{            
            Mail::send('customer.verify', ['Customer' => $Customer], function($message) use ($Customer)
            {
                $message->from('cibodas.store@gmail.com');
                $message->to($Customer->email)->subject('Welcome!');
            });    
            $id = DB::table('users')->insertGetId(
            ['email' => $Customer->email, 'password' => $Customer->password, 'name' => $Customer->name, 'street' => $Customer->street, 
            'city' => $Customer->city, 'province' => $Customer->province, 'zip_code' => $Customer->zip_code, 'phone' => $Customer->phone, 
            'confirmation_code' => $Customer->confirmation_code, 'role' => 'customer']
            );            
            DB::table('customers')->insert(
                ['user_id' => $id, 'gender' => $Customer->gender]
                );
            $auth['Response']= true;
        }    
        return $auth; 
    }
        
    

    public function confirm($confirmation_code)
    {
        $user = DB::table('users')
        ->where('confirmation_code', $confirmation_code)
        ->get();
        if(count($user)>0){
            // return $user;
            DB::table('users')
            ->where('confirmation_code', $confirmation_code)
            ->update(['status' => 1,'confirmation_code' => 1]);
            
            echo 'Your Account Has Been Verified !';
        }else
        echo 'Confirmation Code Failed';
        // echo $user->email;
        // return $user;
    }

    public function getLogin(Request $request){
        $customer=DB::table('users')
        ->join('customers', 'users.id', '=', 'customers.user_id')
        ->select('users.*', 'customers.id as ID_CUSTOMER', 'GENDER')
        ->where('email', $request->input('email'))
        ->where('password', $request->input('password'))
        ->get();
        return $customer;
    }

    public function maintainLogin(Request $request){
        $customer=DB::table('users')
        ->join('customers', 'users.id', '=', 'customers.user_id')
        ->select('users.*', 'customers.id as ID_CUSTOMER', 'GENDER')
        ->where('customers.id', $request->input('id_customer'))
        ->get();
        return $customer;
    }
    

    public function requestLinkPassword(Request $request){
        $check=DB::table('users')
        ->where('email', $request->input('email'))
        ->get();
        if(count($check)>0){
            $Customer = new Customer;        
            $Customer->email= $request->input('email');
            $Customer->confirmation_code= str_random(30);
            DB::table('users')
            ->where('email', $request->input('email'))
            ->update(['confirmation_code' => $Customer->confirmation_code]);
            Mail::send('customer.linkpassword', ['Customer' => $Customer], function($message) use ($Customer)
            {
                $message->from('cibodas.store@gmail.com');
                $message->to($Customer->email)->subject('Reset Password');
            });    
            $auth['Response']= true;
        }else
            $auth['Response']= false;
        return $auth;
    }

    public function getLinkPassword($confirmation_code){
        $user = DB::table('users')
        ->where('confirmation_code', $confirmation_code)
        ->get();
        if(count($user)>0){
            return view('customer.resetpassword', ['confirmation_code' => $confirmation_code]);
        }else{
            echo 'shitstain';
        }         
    }

    public function reset(Request $request){
        $model = DB::table('users')
        ->where('confirmation_code', $request->confirmation_code)
        ->update(['password' => $request->password,'confirmation_code' => 1]);
        if($model==1){
            echo 'success';
        }else{
            echo 'failed';
        }
        
    }

    public function updateAddress(Request $request){
        $model = DB::table('users')
        ->where('id', $request->input('user_id'))
        ->update(['street' => $request->input('street'), 'zip_code' => $request->input('zip_code'), 
            'city' => $request->input('city'), 'province' => $request->input('province') ]);
        if($model==1){
            $response['Response']=true;
        }else{
            $response['Response']=false;
        }        
        return $response;
    }
  
}