<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TernakModel;

use DB;

use App\Quotation;

class TernakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ternak = TernakModel::all();
        return redirect ('products.list.listTernak', ['ternak'=>$ternak]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.create.createTernak');
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
            'year'          => 'required',
            'month'         => 'required',
            'day'           => 'required',
            'gender'        => 'required',
            'weight'        => 'required',
            'price'         => 'required',
            'fotoTernak1'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTernak2'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTernak3'   => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTernak4'   => 'required|image|mimes:jpeg,png|max:1048576'
        ]);

        $ternak = new TernakModel;
        $ternak->idMerchant = $request->idMerchant;
        $ternak->title      = $request->title;
        $ternak->desc       = $request->desc;
        $ternak->year       = $request->year;
        $ternak->month      = $request->month;
        $ternak->day        = $request->day;
        $ternak->gender     = $request->gender;
        $ternak->weight     = $request->weight;
        $ternak->price      = $request->price;

        $files = [];
        if ($request->file('fotoTernak1')) $files[] = $request->file('fotoTernak1');
        if ($request->file('fotoTernak2')) $files[] = $request->file('fotoTernak2');
        if ($request->file('fotoTernak3')) $files[] = $request->file('fotoTernak3');
        if ($request->file('fotoTernak4')) $files[] = $request->file('fotoTernak4');

        $i = 1;
        $currentId = DB::table('produkTernak')->max('id') + 1;

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$ternak->idMerchant.'-'.$currentId.'-fotoTernak'.$i.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/produkTernak/', $filename);
                
                $var = "fotoTernak".$i;

                $ternak->$var = 'images/produkTernak/'.$filename;
            }
            $i++;
        }
        
        // var_dump($ternak->fotoTernak1);

        $ternak->save();

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
        $ternak = TernakModel::find($id);
        if(!$ternak){
            abort(404);
        }
        return view('products.view.viewTernak')->with('ternak', $ternak);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ternak = TernakModel::find($id);
        if(!$ternak){
            abort(404);
        }
        return view('products.edit.editTernak')->with('ternak', $ternak);
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
            'year'      => 'required',
            'month'     => 'required',
            'day'       => 'required',
            'gender'    => 'required',
            'weight'    => 'required',
            'price'     => 'required',
        ]);

        $ternak = TernakModel::find($id);
        $ternak->idMerchant = $request->idMerchant;
        $ternak->title = $request->title;
        $ternak->desc = $request->desc;
        $ternak->year = $request->year;
        $ternak->month = $request->month;
        $ternak->day = $request->day;
        $ternak->gender = $request->gender;
        $ternak->weight = $request->weight;
        $ternak->price = $request->price;

        foreach ($files as $file)
        {
            if ($request->hasFile('fotoTernak1')) {
                $filename=$ternak->idMerchant.'-'.$ternak->id.'-fotoTernak1'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTernak/', $filename);
                
                $ternak->fotoTernak1 = 'images/produkTernak/'.$filename;
            }elseif ($request->hasFile('fotoTernak2')) {
                $filename=$ternak->idMerchant.'-'.$ternak->id.'-fotoTernak2'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTernak/', $filename);
                
                $ternak->fotoTernak2 = 'images/produkTernak/'.$filename;
            }elseif ($request->hasFile('fotoTernak3')) {
                $filename=$ternak->idMerchant.'-'.$ternak->id.'-fotoTernak3'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTernak/', $filename);
                
                $ternak->fotoTernak3 = 'images/produkTernak/'.$filename;
            }elseif ($request->hasFile('fotoTernak4')) {
                $filename=$ternak->idMerchant.'-'.$ternak->id.'-fotoTernak4'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTernak/', $filename);
                
                $ternak->fotoTernak4 = 'images/produkTernak/'.$filename;
            }
        }

        $ternak->save();

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
        $ternak = TernakModel::find($id);
        $ternak->delete();
        return redirect('/');
    }
}
