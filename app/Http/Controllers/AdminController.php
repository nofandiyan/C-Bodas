<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class AdminController extends Controller
{

    public function index()
    {
        $profiles   = DB::table('users')
            ->join('cities','cities.id','=','users.city_id')
            ->join('provinces','provinces.id','=','cities.province_id')
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street','cities.city','cities.type','provinces.province','users.zip_code')
            ->where('users.id', '=', Auth::user()->id)
            ->first();
            return view ('admin.AdminProfile', compact('profiles'));
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

        return view ('admin.AdminSignUp', compact('province','cities'));
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
            ->select('users.id','users.email','users.name','users.gender','users.phone','users.street', 'users.city_id', 'cities.city','cities.type', 'provinces.id as idProvince','provinces.province','users.zip_code')
            ->where('users.id', '=', Auth::user()->id)
            ->first();

        if (Auth::user()->role=='admin') {
            return view ('admin.AdminProfileEdit', compact('profiles','province','cities'));
        }else{
            return redirect('/');
        }

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

        if (Auth::user()->role=='admin') {
            return redirect('/AdminProfile');
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
