<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TaniModel;

// use Validator;

use DB;

use App\Quotation;

class TaniController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tani = TaniModel::all();
        return redirect ('products.list.listTani', ['tani'=>$tani]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('products.create.createTani');
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
            'stock'     => 'required|max:255|min:1',
            'massStock' => 'required',
            'price'     => 'required',
            'massSell'  => 'required',
            'fotoTani1' => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTani2' => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTani3' => 'required|image|mimes:jpeg,png|max:1048576',
            'fotoTani4' => 'required|image|mimes:jpeg,png|max:1048576'
        ]);


        $tani = new TaniModel;
        $tani->idMerchant = $request->idMerchant;
        $tani->title = $request->title;
        $tani->desc = $request->desc;
        $tani->stock = $request->stock;
        $tani->massStock = $request->massStock;
        $tani->price = $request->price;
        $tani->massSell = $request->massSell;
        
        $files =[];
        if ($request->file('fotoTani1')) $files[] = $request->file('fotoTani1');
        if ($request->file('fotoTani2')) $files[] = $request->file('fotoTani2');
        if ($request->file('fotoTani3')) $files[] = $request->file('fotoTani3');
        if ($request->file('fotoTani4')) $files[] = $request->file('fotoTani4');
        
        $i = 1;
        $currentId = DB::table('produkTani')->max('id') + 1;

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$tani->idMerchant.'-'.$currentId.'-fotoTani'.$i.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/produkTani/', $filename);
                
                $var = "fotoTani".$i;
                $tani->$var = 'images/produkTani/'.$filename;
            }
            $i++;
        }

        // print_r($currentId);
        // var_dump($currentId);

        $tani->save();
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
        $tani = TaniModel::find($id);
        if(!$tani){
            abort(404);
        }
        return view('products.view.viewTani')->with('tani', $tani);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tani = TaniModel::find($id);
        if(!$tani){
            abort(404);
        }
        return view('products.edit.editTani')->with('tani', $tani);
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
            'stock'     => 'required|max:255|min:1',
            'massStock' => 'required',
            'price'     => 'required',
            'massSell'  => 'required',
        ]);

        $tani = TaniModel::find($id);
        $tani->idMerchant = $request->idMerchant;
        $tani->title = $request->title;
        $tani->desc = $request->desc;
        $tani->stock = $request->stock;
        $tani->massStock = $request->massStock;
        $tani->price = $request->price;
        $tani->massSell = $request->massSell;

        $files = [];
        if ($request->file('fotoTani1')) $files[] = $request->file('fotoTani1');
        if ($request->file('fotoTani2')) $files[] = $request->file('fotoTani2');
        if ($request->file('fotoTani3')) $files[] = $request->file('fotoTani3');
        if ($request->file('fotoTani4')) $files[] = $request->file('fotoTani4');

        foreach ($files as $file)
        {
            if ($request->hasFile('fotoTani1')) {
                $filename=$tani->idMerchant.'-'.$tani->id.'-fotoTani1'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTani/', $filename);
                
                $tani->fotoTani1 = 'images/produkTani/'.$filename;
            }elseif ($request->hasFile('fotoTani2')) {
                $filename=$tani->idMerchant.'-'.$tani->id.'-fotoTani2'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTani/', $filename);
                
                $tani->fotoTani2 = 'images/produkTani/'.$filename;
            }elseif ($request->hasFile('fotoTani3')) {
                $filename=$tani->idMerchant.'-'.$tani->id.'-fotoTani3'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTani/', $filename);
                
                $tani->fotoTani3 = 'images/produkTani/'.$filename;
            }elseif ($request->hasFile('fotoTani4')) {
                $filename=$tani->idMerchant.'-'.$tani->id.'-fotoTani4'.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/produkTani/', $filename);
                
                $tani->fotoTani4 = 'images/produkTani/'.$filename;
            }
        }

        $tani->save();

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
        $tani = TaniModel::find($id);
        $tani->delete();
        return redirect('/');
    }
}
