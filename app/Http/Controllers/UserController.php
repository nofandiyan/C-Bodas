<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\UserModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserModel::all();
        return view ('user.profile', ['users'=>$users]);
    }

    public function editProfile()
    {
        $users = UserModel::all();
        return view ('user.editProfile', ['users'=>$users]);
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
        $users = UserModel::find($id);

        if(!$users){
            abort(404);
        }

        return view('user.editProfile')->with('user', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = UserModel::find($id);

        if(!$users){
            abort(404);
        }

        return view('user.editProfile')->with('user', $users);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'telp' => 'required|max:12',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'prov' => 'required|max:255',
            'zipCode' => 'required|max:5',
        ]);

        $users = UserModel::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->telp = $request->telp;
        $users->street = $request->street;
        $users->city = $request->city;
        $users->prov = $request->prov;
        $users->zipCode = $request->zipCode;

        $users->save();
        return redirect('user.profile')->with('message', 'profil telah terupdate');
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
