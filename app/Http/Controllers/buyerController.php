<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class buyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = User::find($id);
        return view ('buyer.buyerProfile', ['profile'=>$profile]);
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
        return view('buyer.buyerProfileEdit')->with('profile', $profile);
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
            'typeId'    => 'required',
            'noId'      => 'required',
            'name'      => 'required',
            'telp'      => 'required',
            'street'    => 'required',
            'city'      => 'required',
            'prov'      => 'required',
            'zipCode'   => 'required',
            'bankName'  => 'required',
            'rekName'   => 'required',
            'rekId'     => 'required'
        ]);

        $data = User::find($id);
        $data->userAs   = $request->userAs;
        $data->email    = $request->email;
        $data->typeId   = $request->typeId;
        $data->noId     = $request->noId;
        $data->name     = $request->name;
        $data->telp     = $request->telp;
        $data->street   = $request->street;
        $data->city     = $request->city;
        $data->prov     = $request->prov;
        $data->zipCode  = $request->zipCode;
        $data->bankName = $request->bankName;
        $data->rekName  = $request->rekName;
        $data->rekId    = $request->rekId;

        if ($request->file('profPict')) $file = $request->file('profPict');

        if ($request->hasFile('profPict')) {

                $filename=$data->id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/profile/', $filename);
                
                $data->profPict = 'images/profile/'.$filename;
        }
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
        $data = User::find($id);
        $data->delete();
        return redirect('/');
    }
}
