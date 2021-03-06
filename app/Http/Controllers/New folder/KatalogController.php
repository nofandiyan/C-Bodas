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

class KatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //Pertanian
    public function showKatalogpertanian()
    {
        $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('category_id', '=' , 1 )
            ->get();


        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }

        
        // echo "<pre>";
        // var_dump($barang);
        // die();

    return view('templates.katalogpertanian', compact('barang')); 
    }

    //Peternakan

    public function showKatalogpeternakan()
    {
        $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('category_id', '=' , 2 )
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }

    return view('templates.katalogpeternakan', compact('barang')); 
    }



    //sayur organik
    public function showSayurorganik()
    {
        $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('type_product', '=' , 'Sayur Organik' )
            ->paginate(9);



        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }

    return view('templates.katalogsayurorganik', compact('barang')); 
    }

    //sayur anorganik
     public function showSayuranorganik()
    {
        $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('type_product', '=' , 'Sayur Anorganik' )
            ->paginate(9);


        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }
        /*echo "<pre>";
        var_dump($barang);
        die();*/
    return view('templates.katalogsayuranorganik', compact('barang')); 
    }

    //buah organik
     public function showBuahorganik()
    {
      

        $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('type_product', '=' , 'Buah Organik' )
            ->paginate(9);


        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }

    return view('templates.katalogbuahorganik', compact('barang','total')); 
    }

    //buah anorganik
     public function showBuahanorganik()
    {
            $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('type_product', '=' , 'Buah Anorganik' )
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }



    return view('templates.katalogbuahanorganik', compact('barang')); 
    }

    
    //Pariwisata

    public function showKatalogpariwisata()
    {
       $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
            ->where('category_id', '=' , 3 )
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }

    return view('templates.katalogpariwisata', compact('barang')); 
    }

    public function showSingleproduct()
    {
         $barang = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','detail_products.description','detail_products.stock','prices_products.price')
            ->where('type_product', '=' , 'Buah Anorganik' )
            ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->id)
            ->get();
        }
        return view('templates.single-product');
    }
}
