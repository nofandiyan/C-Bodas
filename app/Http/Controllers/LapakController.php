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
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('detail_products.id', '=', $id)
            ->first();

        $gambars = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();

        return view('lapak.viewLapak', compact('lapak', 'gambars'));
    }

    public function edit($id)
    {
        
        $lapak = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('detail_products.id', '=', $id)
            ->first();

        $gambars = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();
        
        return view('lapak.editLapak', compact('lapak', 'gambars'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required',
            'stock'         => 'required',
            'description'   => 'required',
        ]);

        $product = ProductsModel::find($id);
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->save();

        $seller = DB::table('sellers')->where('user_id', Auth::user()->id)->value('id');

        $detail = Detail_ProductsModel::find($id);
        $detail->product_id   = $product->id;
        $detail->seller_id    = $seller;
        $detail->rating       = 0.0;
        $detail->stock        = $request->stock;
        $detail->description  = $request->description;
        $detail->save();

        $price = Prices_ProductsModel::find($id);
        $price->detail_product_id   = $detail->id;
        $price->price               = $request->price;
        $price->save();

        return redirect('/');
    }
}
