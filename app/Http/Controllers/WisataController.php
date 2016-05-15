<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\WisataModel;

use DB;

use App\Quotation;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wisata = WisataModel::all();
        return redirect ('products.list.listWisata', ['wisata'=>$wisata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.create.createWisata');
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
            'title'     => 'required|max:255|min:5',
            'desc'      => 'required|max:255|min:5',
            'street'        => 'required',
            'village'       => 'required',
            'city'          => 'required',
            'prov'          => 'required',
            'zipCode'       => 'required|min:5|max:5',
            'ticketStock'   => 'required|min:1',
            'price'         => 'required',
            'fotoWisata1'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoWisata2'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoWisata3'    => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoWisata4'    => 'required|image|mimes:jpeg,png|max:1048576'
        ]);

        $wisata = new WisataModel;
        $wisata->idMerchant = $request->idMerchant;
        $wisata->title = $request->title;
        $wisata->desc = $request->desc;
        $wisata->street = $request->street;
        $wisata->village = $request->village;
        $wisata->city = $request->city;
        $wisata->prov = $request->prov;
        $wisata->zipCode = $request->zipCode;
        $wisata->ticketStock = $request->ticketStock;
        $wisata->price = $request->price;

        $files = [];
        if ($request->file('fotoWisata1')) $files[] = $request->file('fotoWisata1');
        if ($request->file('fotoWisata2')) $files[] = $request->file('fotoWisata2');
        if ($request->file('fotoWisata3')) $files[] = $request->file('fotoWisata3');
        if ($request->file('fotoWisata4')) $files[] = $request->file('fotoWisata4');
        
        $i = 1;
        $currentId = DB::table('produkWisata')->max('id') + 1;

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$wisata->idMerchant.'-'.$currentId.'-fotoWisata'.$i.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/produkWisata/', $filename);
                
                $var = "fotoWisata".$i;
                $wisata->$var = 'images/produkWisata/'.$filename;
            }
            $i++;
        }

        $wisata->save();

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
        $wisata = WisataModel::find($id);
        if(!$wisata){
            abort(404);
        }
        return view('products.view.viewWisata')->with('wisata', $wisata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wisata = WisataModel::find($id);
        if(!$wisata){
            abort(404);
        }
        return view('products.edit.editWisata')->with('wisata', $wisata);
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
            'ticketStock'   => 'required|min:1',
            'price'         => 'required',
        ]);

        $wisata = WisataModel::find($id);
        $wisata->idMerchant = $request->idMerchant;
        $wisata->title = $request->title;
        $wisata->desc = $request->desc;
        $wisata->street = $request->street;
        $wisata->village = $request->village;
        $wisata->city = $request->city;
        $wisata->prov = $request->prov;
        $wisata->zipCode = $request->zipCode;
        $wisata->ticketStock = $request->ticketStock;
        $wisata->price = $request->price;

        $wisata->save();

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
        $wisata = WisataModel::find($id);
        $wisata->delete();
        return redirect('/');
    }
}
