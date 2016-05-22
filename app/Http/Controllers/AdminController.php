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

        $profiles   = DB::table('users')->where('id', '=', Auth::user()->id)->get();
            return view ('admin.AdminProfile', compact('profiles'));
    }

    public function showSignUp()
    {
        return view ('admin.AdminSignUp');
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
        $profiles   = DB::table('users')->where('id', '=', Auth::user()->id)->get();
            return view ('admin.AdminProfileEdit', compact('profiles'));
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
            'zip_code'      => 'required'
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

        return redirect('/AdminProfile');
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
