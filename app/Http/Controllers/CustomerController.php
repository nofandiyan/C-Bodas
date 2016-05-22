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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function index($id)
    public function index()
    {
        // $profiles = User::find($id);
        // return view ('seller.sellerProfile', ['profiles'=>$profiles]);

        $profiles   = DB::table('users')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.user_id')
                     ->where('customers.user_id', '=', Auth::user()->id);
            })
            ->get();
            return view ('customer.customerProfile', compact('profiles'));
    }

    public function showSignUp()
    {
        return view('customer.customerSignUp'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit()
    {
        // $profile = User::find($id);
        // if(!$profile){
        //     abort(404);
        // }
        // return view('seller.sellerProfileEdit')->with('profile', $profile);
        $profiles   = DB::table('users')
            ->join('customers', function ($join) {
                $join->on('users.id', '=', 'customers.user_id')
                     ->where('customers.user_id', '=', Auth::user()->id);
            })
            ->get();
            return view ('customer.customerProfileEdit', compact('profiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'phone'         => 'required',
            'street'        => 'required',
            'city'          => 'required',
            'province'      => 'required',
            'zip_code'      => 'required',
            'gender'        => 'required'
        ]);
        
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name'      => Input::get('name'),
                'phone'     => Input::get('phone'),
                'street'    => Input::get('street'),
                'city'      => Input::get('city'),
                'province'  => Input::get('province'),
                'zip_code'  => Input::get('zip_code'),
                ]);

        DB::table('customers')
            ->where('user_id', Auth::user()->id)
            ->update([
                'gender'     => Input::get('gender'),
                ]);

        return redirect('/CustomerProfile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('/');
    }
}
