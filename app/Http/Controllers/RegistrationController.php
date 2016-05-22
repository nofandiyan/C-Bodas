<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input as Input;

// use Validator, Redirect, Session;
use Illuminate\Support\Facades\ Session as Session;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Redirect as Redirect;

use App\User;
use App\SellerModel;

use Hash, Mail;

class RegistrationController extends Controller
{
    public function postRegister()
    {
      $rules = [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|confirmed|min:6',
        ];
 
        $input = Input::only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );
 
        $validator = Validator::make($input, $rules);
 
        if($validator->fails())
        {
          return Redirect::to('register')->withInput()->withErrors($validator);
        }
 
        $confirmation_code = str_random(30);
 
        // User::create([
        //     'name' => Input::get('name'),
        //     'email' => Input::get('email'),
        //     'password' => Hash::make(Input::get('password')),
        //     'confirmation_code' => $confirmation_code
        // ]);

        $user=User::create([
            'name'      => Input::get('name'),
            'email'     => Input::get('email'),
            'password'  => bcrypt(Input::get('password')),
            'street'    => Input::get('street'),
            'city'      => Input::get('city'),
            'province'  => Input::get('province'),
            'zip_code'  => Input::get('zip_code'),
            'phone'     => Input::get('phone'),
            'status'    => Input::get('status'),
            'confirmation_code' => $confirmation_code,
            'role'      => Input::get('role'),
        ]);
        $user->save();

        if (Input::get('role')=="seller") {
            // if (!empty(Input::get('prof_pic')) {
            //     $file=Input::get('prof_pic');
            //     $destinationPath = 'images/profile/';
            //     $uploadSuccess = $file->move(public_path().'/'.$destinationPath,
            //         $user->id.'-'.$user->role.'-'.$file->getClientOriginalName());

            //     $prof_pic = $destinationPath.$user->id.'-'.$user->role.'-'.$file->getClientOriginalName();    
            // }
            $seller = SellerModel::create([
                'user_id'       => $user->id,
                'type_id'       => Input::get('type_id'),
                'no_id'         => Input::get('no_id'),
                'rating'        => 0.0,
                'bank_account'  => Input::get('bank_account'),
                'account_number'=> Input::get('account_number'),
                'bank_name'     => Input::get('bank_name'),
                // 'prof_pic'      => $prof_pic
            ]);
            $seller->save();
        }elseif (Input::get('role')=="customer") {
            $customer = CustomerModel::create([
                'user_id'      => $user->id,
                'gender'       => Input::get('gender'),
            ]);
            $customer->save();
        }
 
      	Mail::send('email.verify', ['confirmation_code' => $confirmation_code], function($m) {
            $m->from('noreply@c-bodas.com', 'C-Bodas');
            $m->to(Input::get('email'), Input::get('name'))
                ->subject('Konfirmasi alamat email anda');
        });
 
        Session::flash('message', 'Terima kasih telah mendaftar! Silahkan cek email anda untuk konfirmasi.');
 
        return Redirect::to('login');
    }

    public function confirm($confirmation_code)
    {
        if(!$confirmation_code)
        {
            return "link tidak terdaftar";
        }
 
        $user = User::where('confirmation_code', $confirmation_code)->first();
 
        if (!$user)
        {
            return "link tidak terdaftar";
        }
 
        $user->status = 1;
        $user->confirmation_code = 1;
        $user->save();
 
        Session::flash('message', 'Akun anda telah berhasil di verifikasi, silahkan login!');
 
        return Redirect::to('login');
    }
}
