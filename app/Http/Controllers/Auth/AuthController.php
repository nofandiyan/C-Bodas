<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\SellerModel;
use App\CustomerModel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    // protected function create(array $data)
    // {
        
    //     $user=User::create([
    //         'name'      => $data['name'],
    //         'email'     => $data['email'],
    //         'password'  => bcrypt($data['password']),
    //         'street'    => $data['street'],
    //         'city'      => $data['city'],
    //         'province'  => $data['province'],
    //         'zip_code'  => $data['zip_code'],
    //         'phone'     => $data['phone'],
    //         'status'    => $data['status'],
    //         'confirmation_code' => $data['confirmation_code'],
    //         'role'      => $data['role'],
    //     ]);
    //     $user->save();

    //     if ($data["role"]=="seller") {
    //         if (!empty($data['prof_pic'])) {
    //             $file=$data['prof_pic'];
    //             $destinationPath = 'images/profile/';
    //             $uploadSuccess = $file->move(public_path().'/'.$destinationPath,
    //                 $user->id.'-'.$user->role.'-'.$file->getClientOriginalName());

    //             $prof_pic = $destinationPath.$user->id.'-'.$user->role.'-'.$file->getClientOriginalName();    
    //         }
    //         $seller = SellerModel::create([
    //             'user_id'       => $user->id,
    //             'type_id'       => $data['type_id'],
    //             'no_id'         => $data['no_id'],
    //             'rating'        => 0.0,
    //             'bank_account'  => $data['bank_account'],
    //             'account_number'=> $data['account_number'],
    //             'bank_name'     => $data['bank_name'],
    //             'prof_pic'      => $prof_pic
    //         ]);
    //         $seller->save();
    //     }elseif ($data["role"]=="customer") {
    //         $customer = CustomerModel::create([
    //             'user_id'      => $user->id,
    //             'gender'       => $data['gender'],
    //         ]);
    //         $customer->save();
    //     }
        

    //     return $user;
    // }
}
