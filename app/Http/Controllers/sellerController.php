<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class sellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = User::find($id);
        return view ('seller.sellerEdit', ['profile'=>$profile]);
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
    public function edit($id)
    {
        $profile = User::find($id);
        if(!$profile){
            abort(404);
        }
        return view('seller.sellerEdit')->with('profile', $profile);
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
            'userAs'    => $data['userAs'],
            'email'     => $data['email'],
            'profPict'  => $data['profPict'],
            'password'  => bcrypt($data['password']),
            'typeId'    => $data['typeId'],
            'noId'      => $data['noId'],
            'name'      => $data['name'],
            'telp'      => $data['telp'],
            'street'    => $data['street'],
            'city'      => $data['city'],
            'prov'      => $data['prov'],
            'zipCode'   => $data['zipCode'],
            'bankName'  => $data['bankName'],
            'rekName'   => $data['rekName'],
            'rekId'     => $data['rekId'],
        ]);

        $data = UserModel::find($id);
        $data->title = $request->title;
        $data->desc = $request->desc;
        $data->year = $request->year;
        $data->month = $request->month;
        $data->day = $request->day;
        $data->gender = $request->gender;
        $data->weight = $request->weight;
        $data->price = $request->price;

        $data->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
