<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\VillaModel;

use DB;

use App\Quotation;

class VillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villa = VillaModel::all();
        return redirect ('products.list.listVilla', ['villa'=>$villa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.create.createVilla');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title'         => 'required|max:255|min:5',
            'desc'          => 'required|max:255|min:5',
            'street'        => 'required',
            'village'       => 'required',
            'city'          => 'required',
            'prov'          => 'required',
            'zipCode'       => 'required|min:5|max:5',
            'dateOrdered'   => 'required',
            'quota'         => 'required',
            'price'         => 'required',
            'fotoVilla1'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoVilla2'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoVilla3'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoVilla4'    => 'required|image|mimes:jpeg,png|max:1048576'
        ]);

        $villa = new VillaModel;
        $villa->idMerchant = $request->idMerchant;
        $villa->title = $request->title;
        $villa->desc = $request->desc;
        $villa->street = $request->street;
        $villa->village = $request->village;
        $villa->city = $request->city;
        $villa->prov = $request->prov;
        $villa->zipCode = $request->zipCode;
        $villa->dateOrdered = $request->dateOrdered;
        $villa->quota = $request->quota;
        $villa->price = $request->price;

        $files = [];
        if ($request->file('fotoVilla1')) $files[] = $request->file('fotoVilla1');
        if ($request->file('fotoVilla2')) $files[] = $request->file('fotoVilla2');
        if ($request->file('fotoVilla3')) $files[] = $request->file('fotoVilla3');
        if ($request->file('fotoVilla4')) $files[] = $request->file('fotoVilla4');
        
        $i = 1;
        $currentId = DB::table('produkVilla')->max('id') + 1;

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$villa->idMerchant.'-'.$currentId.'-fotoVilla'.$i.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/produkVilla/', $filename);
                
                $var = "fotoVilla".$i;
                $villa->$var = 'images/produkVilla/'.$filename;
            }
            $i++;
        }

        $villa->save();

        return redirect ('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $villa = VillaModel::find($id);
        if(!$villa){
            abort(404);
        }
        return view('products.view.viewVilla')->with('villa', $villa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $villa = VillaModel::find($id);
        if(!$villa){
            abort(404);
        }
        return view('products.edit.editVilla')->with('villa', $villa);
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
            'title'     => 'required|max:255|min:5',
            'desc'      => 'required|max:255|min:5',
            'street'        => 'required',
            'village'       => 'required',
            'city'          => 'required',
            'prov'          => 'required',
            'zipCode'       => 'required|min:5|max:5',
            'dateOrdered'   => 'required',
            'quota'         => 'required',
            'price'         => 'required',
        ]);

        $villa = VillaModel::find($id);
        $villa->idMerchant = $request->idMerchant;
        $villa->title = $request->title;
        $villa->desc = $request->desc;
        $villa->street = $request->street;
        $villa->village = $request->village;
        $villa->city = $request->city;
        $villa->prov = $request->prov;
        $villa->zipCode = $request->zipCode;
        $villa->dateOrdered = $request->dateOrdered;
        $villa->quota = $request->quota;
        $villa->price = $request->price;

        $villa->save();

        return redirect ('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $villa = VillaModel::find($id);
        $villa->delete();
        return redirect('/');
    }
}
