<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CustomerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street','cities.city','cities.type','provinces.province','users.zip_code')
            ->where('users.id', '=', Auth::user()->id)
            ->first();
            return view ('customer.customerProfile', compact('profiles'));
    }

    public function showSignUp()
    {
        $province = DB::table('provinces')
            ->select('provinces.id', 'provinces.province')
            ->get();

        $cities = DB::table('cities')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->select('cities.id','cities.city','cities.province_id', 'cities.type','provinces.province')
            ->get();

        return view('customer.CustomerSignUp', compact('province','cities')); 
    }

    public function edit()
    {
        $province = DB::table('provinces')
            ->select('provinces.id', 'provinces.province')
            ->get();

        $cities = DB::table('cities')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->select('cities.id','cities.city','cities.province_id', 'cities.type','provinces.province')
            ->get();

        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.id')
                     ->where('customers.id', '=', Auth::user()->id);
            })
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street', 'users.city_id', 'cities.city', 'cities.type', 'provinces.id as idProvince','provinces.province','users.zip_code')
            ->first();
            
        if (Auth::user()->role=='customer') {
            return view ('customer.CustomerProfileEdit', compact('profiles','province','cities'));
        }else{
            return redirect('/');
        }
    }

    public function show($id)
    {
        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->join('customers', 'users.id', '=', 'customers.id')
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street','cities.city','cities.type','provinces.province','users.zip_code')
            ->where('customers.id','=', $id)
            ->first();

        if (count($profiles) == 0) {
            return redirect('/');
        }

            return view ('customer.customerProfile', compact('profiles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'phone'         => 'required',
            'gender'         => 'required',
            'street'        => 'required',
            'city_id'       => 'required',
            'zip_code'      => 'required'
        ]);
        
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name'      => Input::get('name'),
                'phone'     => Input::get('phone'),
                'gender'    => Input::get('gender'),
                'street'    => Input::get('street'),
                'city_id'   => Input::get('city_id'),
                'zip_code'  => Input::get('zip_code'),
                ]);

        if (Auth::user()->role=='customer') {
            return redirect('/CustomerProfile');
        }else{
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('/');
    }
}
