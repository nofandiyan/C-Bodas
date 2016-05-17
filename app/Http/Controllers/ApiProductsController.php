<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiProductsController extends Controller
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
        ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
        ->join('users', 'sellers.user_id', '=', 'users.id')
        ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.category_id as id_category', 'category_products.category_name', 
            'sellers.id as id_seller', 'users.name as seller_name', 'prices_products.id as id_price', 'prices_products.price')
        ->where('products.category_id', '=', 1)
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
        ->groupBy('detail_products.id')
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.detail_product_id', "=", $user->id_detail_product)
            ->get();
        }
        return $first;
    }

    public function getPariwisataCatalog(){
        $first = DB::table('detail_products')
        ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
        ->join('users', 'sellers.user_id', '=', 'users.id')
        ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.category_id as id_category', 'category_products.category_name', 
            'sellers.id as id_seller', 'users.name as seller_name', 'prices_products.id as id_price', 'prices_products.price')
        ->where('products.category_id', '=', 2)
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
        ->groupBy('detail_products.id')
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.detail_product_id', "=", $user->id_detail_product)
            ->get();
        }
        return $first;  
    }

    public function findProductName(Request $request){
        
        // var_dump($request->input('cari'));
        $name=$request->input('find');
        $first = DB::table('detail_products')
        ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
        ->join('users', 'sellers.user_id', '=', 'users.id')
        ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.rating', 
            'detail_products.description', 'detail_products.stock', 'products.category_id as id_category', 'category_products.category_name', 
            'sellers.id as id_seller', 'users.name as seller_name', 'prices_products.id as id_price', 'prices_products.price')
        ->where('products.name', 'like', '%'.$name.'%')
        ->orWhere('category_products.category_name', 'like', '%'.$name.'%')
        ->where('prices_products.created_at', DB::raw("(select max(t2.created_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
        ->groupBy('detail_products.id')
        ->get();
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.detail_product_id', "=", $user->id_detail_product)
            ->get();
        }
        return $first;
    }


}