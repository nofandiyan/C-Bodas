<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\EdukasiModel;

use DB;

use App\Quotation;

class EdukasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edukasi = EdukasiModel::all();
        return view ('products.list.listEdukasi', ['edukasi'=>$edukasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.create.createEdukasi');
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
            'dateOrdered'   => '',
            'quota'         => 'required',
            'price'         => 'required',
            'fotoEdukasi1'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoEdukasi2'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoEdukasi3'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoEdukasi4'   => 'required|image|mimes:jpeg,png|max:1048576'
        ]);

        $edukasi = new EdukasiModel;
        $edukasi->idMerchant    = $request->idMerchant;
        $edukasi->title         = $request->title;
        $edukasi->desc          = $request->desc;
        $edukasi->street        = $request->street;
        $edukasi->village       = $request->village;
        $edukasi->city          = $request->city;
        $edukasi->prov          = $request->prov;
        $edukasi->zipCode       = $request->zipCode;
        $edukasi->dateOrdered   = $request->dateOrdered;
        $edukasi->quota         = $request->quota;
        $edukasi->price         = $request->price;

        $files = [];
        if ($request->file('fotoEdukasi1')) $files[] = $request->file('fotoEdukasi1');
        if ($request->file('fotoEdukasi2')) $files[] = $request->file('fotoEdukasi2');
        if ($request->file('fotoEdukasi3')) $files[] = $request->file('fotoEdukasi3');
        if ($request->file('fotoEdukasi4')) $files[] = $request->file('fotoEdukasi4');
        
        $i = 1;
        $currentId = DB::table('produkEdukasi')->max('id') + 1;

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$edukasi->idMerchant.'-'.$currentId.'-fotoEdukasi'.$i.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/produkEdukasi/', $filename);
                
                $var = "fotoEdukasi".$i;
                $edukasi->$var = 'images/produkEdukasi/'.$filename;
            }
            $i++;
        }

        $edukasi->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edukasi = EdukasiModel::find($id);
        if(!$edukasi){
            abort(404);
        }
        return view('products.view.viewEdukasi')->with('edukasi', $edukasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edukasi = EdukasiModel::find($id);
        if(!$edukasi){
            abort(404);
        }
        return view('products.edit.editEdukasi')->with('edukasi', $edukasi);
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
            'dateOrdered'   => '',
            'quota'         => 'required',
            'price'         => 'required',
            // 'fotoEdukasi1'   => 'required|image|mimes:jpeg,png|max:1048576',
            // 'fotoEdukasi2'   => 'required|image|mimes:jpeg,png|max:1048576',
            // 'fotoEdukasi3'   => 'required|image|mimes:jpeg,png|max:1048576',
            // 'fotoEdukasi4'   => 'required|image|mimes:jpeg,png|max:1048576'
        ]);

        $edukasi = EdukasiModel::find($id);
        $edukasi->idMerchant = $request->idMerchant;
        $edukasi->title = $request->title;
        $edukasi->desc = $request->desc;
        $edukasi->street = $request->street;
        $edukasi->village = $request->village;
        $edukasi->city = $request->city;
        $edukasi->prov = $request->prov;
        $edukasi->zipCode = $request->zipCode;
        $edukasi->dateOrdered = $request->dateOrdered;
        $edukasi->quota = $request->quota;
        $edukasi->price = $request->price;

        $files = [];
        if ($request->file('fotoEdukasi1')) $files[] = $request->file('fotoEdukasi1');
        if ($request->file('fotoEdukasi2')) $files[] = $request->file('fotoEdukasi2');
        if ($request->file('fotoEdukasi3')) $files[] = $request->file('fotoEdukasi3');
        if ($request->file('fotoEdukasi4')) $files[] = $request->file('fotoEdukasi4');

        foreach ($files as $file)
        {
            if ($request->hasFile('fotoEdukasi1')) {
                $filename=$edukasi->idMerchant.'-'.$edukasi->id.'-fotoEdukasi1'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkEdukasi/', $filename);
                
                $edukasi->fotoEdukasi1 = 'images/produkEdukasi/'.$filename;
            }elseif ($request->hasFile('fotoEdukasi2')) {
                $filename=$edukasi->idMerchant.'-'.$edukasi->id.'-fotoEdukasi2'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkEdukasi/', $filename);
                
                $edukasi->fotoEdukasi2 = 'images/produkEdukasi/'.$filename;
            }elseif ($request->hasFile('fotoEdukasi3')) {
                $filename=$edukasi->idMerchant.'-'.$edukasi->id.'-fotoEdukasi3'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkEdukasi/', $filename);
                
                $edukasi->fotoEdukasi3 = 'images/produkEdukasi/'.$filename;
            }elseif ($request->hasFile('fotoEdukasi4')) {
                $filename=$edukasi->idMerchant.'-'.$edukasi->id.'-fotoEdukasi4'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkEdukasi/', $filename);
                
                $edukasi->fotoEdukasi4 = 'images/produkEdukasi/'.$filename;
            }
        }

        $edukasi->save();

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
        //
    }
}
