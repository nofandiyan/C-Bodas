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
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id')
                     ->where('sellers.user_id', '=', Auth::user()->id);
            })
            ->get();
            return view ('seller.sellerProfile', compact('profiles'));
    }

    public function showSignUp()
    {
        return view('seller.SellerSignUp');
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
         $profiles   = DB::table('users')
            ->join('sellers', 'users.id','=','sellers.user_id')
            ->where('sellers.id','=', $id)
            ->get();
            return view ('seller.sellerProfile', compact('profiles'));
        
    }

    // public function bannedSeller($id)
    // {
    //      $profiles   = DB::table('users')
    //         ->join('sellers', 'users.id','=','sellers.user_id')
    //         ->where('sellers.id','=', $id)
    //         ->update([
    //             'status'       => 0
    //             ]);
    //         return redirect ('/');
        
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit()
    {
        $profiles   = DB::table('users')
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id')
                     ->where('sellers.user_id', '=', Auth::user()->id);
            })
            ->get();
            return view ('seller.sellerProfileEdit', compact('profiles'));
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
            'type_id'       => 'required',
            'no_id'         => 'required',
            'name'          => 'required',
            'phone'         => 'required',
            'street'        => 'required',
            'city'          => 'required',
            'province'      => 'required',
            'zip_code'      => 'required',
            'bank_name'     => 'required',
            'account_number'=> 'required',
            'bank_account'  => 'required'
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

        $file = Input::file('prof_pic');
        
        $prof_pic = DB::table('sellers')->where('user_id', Auth::user()->id)->value('prof_pic');

        if (!empty($file)) {
            
            $filename=Auth::user()->id.'-'.$file->getClientOriginalName();
                
            $file->move(base_path().'/public/images/profile/', $filename);
            
            $prof_pic = 'images/profile/'.$filename;   
        }

        DB::table('sellers')
            ->where('user_id', Auth::user()->id)
            ->update([
                'type_id'       => Input::get('type_id'),
                'no_id'         => Input::get('no_id'),
                'bank_account'  => Input::get('bank_account'),
                'account_number'=> Input::get('account_number'),
                'bank_name'     => Input::get('bank_name'),
                'prof_pic'      => $prof_pic
                ]);

        return redirect('/SellerProfile');
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
