<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    public function getCatalog(Request $request){
        $name=$request->input('catalog');
        if($name=='agribisnis'){
           return $this->getAgribisnisCatalog();
        }
        if($name=='pariwisata') {
            return $this->getPariwisataCatalog();    
        }
    }

    public function getAgribisnisCatalog(){
        // $custom=Product::where('id_category', '!=', 3)
        // ->get();
        $first = DB::table('detail_products')
        ->join('sellers', 'detail_products.id_seller', '=', 'sellers.id_seller')
        ->join('products', 'detail_products.id_product', '=', 'products.id_product')
        ->join('category_products', 'products.id_category', '=', 'category_products.id_category')
        ->join('prices_products', 'prices_products.id_detail_product', '=', 'detail_products.id_detail_product')
        ->select(DB::raw('DISTINCT(detail_products.id_detail_product)'), 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.id_category', 'category_products.category_name', 
            'sellers.id_seller', 'sellers.name as seller_name', 'prices_products.price')
        ->where('products.id_category', '!=', 3)
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.id_detail_product=detail_products.id_detail_product)"))
        ->groupBy('detail_products.id_detail_product')
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.id_detail_product', "=", $user->id_detail_product)
            ->get();
        }
        return $first;
    }

    public function getPariwisataCatalog(){
        $first = DB::table('detail_products')
        ->join('sellers', 'detail_products.id_seller', '=', 'sellers.id_seller')
        ->join('products', 'detail_products.id_product', '=', 'products.id_product')
        ->join('category_products', 'products.id_category', '=', 'category_products.id_category')
        ->join('prices_products', 'prices_products.id_detail_product', '=', 'detail_products.id_detail_product')
        ->select(DB::raw('DISTINCT(detail_products.id_detail_product)'), 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.id_category', 'category_products.category_name', 
            'sellers.id_seller', 'sellers.name as seller_name', 'prices_products.price')
        ->where('products.id_category', '=', 3)
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.id_detail_product=detail_products.id_detail_product)"))
        ->groupBy('detail_products.id_detail_product')
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.id_detail_product', "=", $user->id_detail_product)
            ->get();
        }
        return $first;  
    }

    public function findProductName(Request $request){
        
        // var_dump($request->input('cari'));
        $name=$request->input('find');
        $first = DB::table('detail_products')        
        ->join('sellers', 'detail_products.id_seller', '=', 'sellers.id_seller')
        ->join('products', 'detail_products.id_product', '=', 'products.id_product')
        ->join('category_products', 'products.id_category', '=', 'category_products.id_category')
        ->join('prices_products', 'prices_products.id_detail_product', '=', 'detail_products.id_detail_product')
        ->select('detail_products.id_detail_product', 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.id_category', 'category_products.category_name', 
            'sellers.id_seller', 'sellers.name as seller_name', 'prices_products.price')
        ->where('products.name', 'like', '%'.$name.'%')
        ->orWhere('category_products.category_name', 'like', '%'.$name.'%')
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.id_detail_product=detail_products.id_detail_product)"))
        ->groupBy('detail_products.id_detail_product')
        ->get();
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.id_detail_product', "=", $user->id_detail_product)
            ->get();
        }
        return $first;
    }


}