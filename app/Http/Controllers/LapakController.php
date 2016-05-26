<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category_ProductsModel;
use App\ProductsModel;
use App\Detail_ProductsModel;
use App\Images_ProductsModel;
use App\Prices_ProductsModel;

use App\SellerModel;

// use Validator;

use DB;

use Auth;

use App\Quotation;

use Illuminate\Support\Facades\Input as Input;

class LapakController extends Controller
{

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'category_name'     => 'required'
        ]);

        $category = new Category_ProductsModel;
        $category->category_name = $request->category_name;
        $category->save();
        return redirect('/');
    }

    public function createTani()
    {
        return view('lapak.createTani');
    }
    public function createTernak()
    {
        return view('lapak.createTernak');
    }
    public function createWisata()
    {
        return view('lapak.createWisata');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required',
            'stock'         => 'required',
            'description'   => 'required',
        ]);

        $product = new ProductsModel;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->save();

        $seller = DB::table('sellers')->where('user_id', Auth::user()->id)->value('id');

        $detail = new Detail_ProductsModel;
        $detail->product_id   = $product->id;
        $detail->seller_id    = $seller;
        $detail->rating       = 0.0;
        $detail->stock        = $request->stock;
        $detail->description  = $request->description;
        $detail->save();

        $price = new Prices_ProductsModel;
        $price->detail_product_id   = $detail->id;
        $price->price               = $request->price;
        $price->save();

        $files = [];
        if ($request->file('foto1')) $files[] = $request->file('foto1');
        if ($request->file('foto2')) $files[] = $request->file('foto2');
        if ($request->file('foto3')) $files[] = $request->file('foto3');
        if ($request->file('foto4')) $files[] = $request->file('foto4');

        foreach ($files as $file)
        {
            if(!empty($file)){
                $filename=$detail->id.'-'.$product->category_id.'-'.$file->getClientOriginalName();
                
                $file->move(base_path().'/public/images/lapak/', $filename);
                
                $images = new Images_ProductsModel;
                $images->detail_product_id   = $detail->id;
                $images->link                = 'images/lapak/'.$filename;
                $images->save();
            }
        }

        return redirect('/');
    }

    public function show($id)
    {
        $lapak = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','products.category_id','detail_products.description','detail_products.stock','prices_products.price')
            ->where('detail_products.id', '=', $id)
            ->first();

        $images = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();

        $prices = DB::table('prices_products')
            ->orderBy('id','desc')
            ->where('detail_product_id', '=', $id)
            ->first();        

        if ($lapak->category_id == 1) {
            return view('lapak.viewLapakTani', compact('lapak', 'images', 'price'));
        }elseif ($lapak->category_id == 2) {
            return view('lapak.viewLapakTernak', compact('lapak', 'images', 'prices'));
        }elseif ($lapak->category_id == 3) {
            return view('lapak.viewLapakWisata', compact('lapak', 'images', 'price'));
        }
        
    }

    public function edit($id)
    {
        
        $lapak = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name', 'products.category_id','detail_products.description','detail_products.stock','prices_products.price')
            ->where('detail_products.id', '=', $id)
            ->first();

        $images = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();

        $prices = DB::table('prices_products')
            ->orderBy('id','desc')
            ->where('detail_product_id', '=', $id)
            ->first();
        
        return view('lapak.editLapak', compact('lapak', 'images', 'prices'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'stock'         => 'required',
            'description'   => 'required'
        ]);

        $detail = Detail_ProductsModel::find($id);
        $detail->description    = $request->description;
        $detail->stock          = $request->stock;
        $detail->save();

        $product = DB::table('products')
            ->where('products.id','=',$detail->product_id)
            ->update([
                'name' => Input::get('name')
                ]);

        $price = DB::table('prices_products')
            ->where('prices_products.detail_product_id','=',$detail->id)
            ->insert([
                'detail_product_id' => $detail->id,
                'price' => Input::get('price')
                ]);

        $files = [];
        if ($request->file('foto1')) $files[] = $request->file('foto1');
        if ($request->file('foto2')) $files[] = $request->file('foto2');
        if ($request->file('foto3')) $files[] = $request->file('foto3');
        if ($request->file('foto4')) $files[] = $request->file('foto4');

        $i=1;

        $category = DB::table('detail_products')
            ->where('detail_products.id','=',$detail->id)
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->select('products.category_id','category_products.category_name')
            ->get();

        foreach ($files as $file)
        {
            if ($request->hasFile('foto'.$i)) {
                $filename=$detail->id.'-'.$category[0]->category_id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/lapak/', $filename);

                $images = DB::table('images_products');
                $images->detail_product_id   = $detail->id;
                $images->link                = 'images/lapak/'.$filename;
                $images->save();
            }
        $i++;
        }

        return redirect('/');
    }

    public function destroy($id)
    {

        // $lapak = DB::table('detail_products')
        //     ->join('products', 'detail_products.product_id', '=', 'products.id')
        //     ->join('category_products', 'products.category_id', '=', 'category_products.id')
        //     ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
        //     ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
        //     ->where('detail_products.id', '=', $id)
        //     ->first();

        // $detail = Detail_ProductsModel::find($id);

        // $product = DB::table('products')
        //     ->where($detail->product_id, '=', 'products.id');

        // echo "<pre>";
        // var_dump($product);
        // die();

        // return redirect('/');
    }
}
