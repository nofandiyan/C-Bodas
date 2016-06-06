<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

use App\Category_ProductsModel;
use App\ProductsModel;
use App\Detail_ProductsModel;
use App\Images_ProductsModel;
use App\Prices_ProductsModel;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function searchhome()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    

       /* $barang = DB::where('name','like','%'.$search.'%')
        ->orderBy('name')
        ->paginate(9);*/
 
    return view('templates.homepage',compact('barang'));
    }

    public function searchsayuranorganik()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    

     
    return view('templates.sayuranorganik',compact('barang'));
    }


    public function searchsayurorganik()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    


    return view('templates.sayurorganik',compact('barang'));
    }

    public function searchbuahorganik()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    


    return view('templates.buahorganik',compact('barang'));
    }

     public function searchbuahanorganik()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    


    return view('templates.buahanorganik',compact('barang'));
    }

    public function searchpeternakan()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('name','like','%'.$search.'%')
            ->orderBy('name')
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
    


    return view('templates.katalogpeternakan',compact('barang'));
    }
   

}
