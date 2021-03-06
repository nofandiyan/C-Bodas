<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class sellerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.id')
                     ->where('sellers.id', '=', Auth::user()->id);
            })
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street','cities.city','cities.type','provinces.province','users.zip_code','sellers.prof_pic','sellers.type_id','sellers.no_id','sellers.bank_name','sellers.bank_account','sellers.account_number')
            ->first();

            return view ('seller.SellerProfile', compact('profiles'));
    }

    public function showSignUp()
    {
        $city = DB::table('cities')
            ->where('cities.city','=','Bandung Barat')
            ->select('*')
            ->first();
        return view('seller.SellerSignUp', compact('city'));
    }

    public function show($id)
    {
        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->join('sellers', 'users.id', '=', 'sellers.id')
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street','cities.city','cities.type','provinces.province','users.zip_code','sellers.prof_pic','sellers.type_id','sellers.no_id','sellers.bank_name','sellers.bank_account','sellers.account_number')
            ->where('sellers.id','=', $id)
            ->first();

            if (count($profiles) == 0) {
            return redirect('/');
        }

            return view ('seller.sellerProfile', compact('profiles'));
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
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.id')
                     ->where('sellers.id', '=', Auth::user()->id);
            })
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street', 'users.city_id','cities.city','cities.type','provinces.province','users.zip_code','sellers.prof_pic','sellers.type_id','sellers.no_id','sellers.bank_name','sellers.bank_account','sellers.account_number')
            ->first();

        if (Auth::user()->role=='seller') {
            return view ('seller.sellerProfileEdit', compact('profiles','province','cities'));
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type_id'       => 'required',
            'no_id'         => 'required',
            'name'          => 'required',
            'phone'         => 'required',
            'gender'        => 'required',
            'street'        => 'required',
            'zip_code'      => 'required',
            'bank_name'     => 'required',
            'account_number'=> 'required',
            'bank_account'  => 'required',
            'prof_pic'      => 'mimes:jpeg,png|max:1000'
        ]);
        
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name'      => Input::get('name'),
                'phone'     => Input::get('phone'),
                'gender'    => Input::get('gender'),
                'street'    => Input::get('street'),
                'zip_code'  => Input::get('zip_code'),
                ]);

        $file = Input::file('prof_pic');
        
        $prof_pic = DB::table('sellers')->where('id', Auth::user()->id)->value('prof_pic');

        if (!empty($file)) {
            
            $filename=Auth::user()->id.'-'.$file->getClientOriginalName();
                
            $file->move(base_path().'/public/images/profile/', $filename);
            
            $prof_pic = 'images/profile/'.$filename;   
        }

        DB::table('sellers')
            ->where('id', Auth::user()->id)
            ->update([
                'type_id'       => Input::get('type_id'),
                'no_id'         => Input::get('no_id'),
                'bank_account'  => Input::get('bank_account'),
                'account_number'=> Input::get('account_number'),
                'bank_name'     => Input::get('bank_name'),
                'prof_pic'      => $prof_pic
                ]);

        if (Auth::user()->role=='seller') {
            return redirect('/SellerProfile');
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
