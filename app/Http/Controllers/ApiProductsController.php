<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use PushNotification; 
use App\Http\Controllers\Notification;
use App\Http\Controllers\ReservationsChecker;

class ApiProductsController extends Controller
{
    use Notification, ReservationsChecker;

    public function __construct(){
        $this->reservationsExpired();
        $this->expReservationsNotification();
    }

    public function getCatalog(Request $request){
        // var_dump(Auth::guard('api')->user());
        // Auth::guard('api')->user();
        $auth = auth()->guard('api'); 
        if (!$auth->check()) {
            return response('Unauthorized.', 401);
        }else{
            $name=$request->input('catalog');
            if($name=='pertanian'){
                return $this->getCatalogByCategory($request->input('offset'), 1);
            } elseif ($name=='peternakan') {
                # code...
                return $this->getCatalogByCategory($request->input('offset'), 2);    
            }elseif ($name=='pariwisata') {
                # code...
               return $this->getCatalogByCategory($request->input('offset'), 3);    
            } elseif ($name=='all'){
                return $this->getAllCatalog($request->input('offset'));    
            }
        }
                    
    }

    public function getAllCatalog($skip){
        // $custom=Product::where('id_category', '!=', 3)
        // ->get();
        $first = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
        ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.type_product',
            'products.category_id as id_category', 'category_products.category_name', 
            'prices_products.id as id_price', 'prices_products.price')
        ->where('prices_products.updated_at', DB::raw("(select max(t2.updated_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
        ->groupBy('detail_products.id')
        ->skip($skip)
        ->take(4)
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.detail_product_id', "=", $user->id_detail_product)
            ->get();
            $user->rating = DB::table('reviews')
            ->where('reviews.detail_product_id', $user->id_detail_product)
            ->avg('rating');
        }
        return $first;
    }

    public function getCatalogByCategory($skip, $idCategory){
        // $custom=Product::where('id_category', '!=', 3)
        // ->get();
        $first = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
        ->select('detail_products.id as id_detail_product', 'products.name as product_name', 
            'products.category_id as id_category', 'category_products.category_name',  
            'detail_products.type_product', 'prices_products.id as id_price', 'prices_products.price')
        ->where('products.category_id', '=', $idCategory)
        ->where('prices_products.updated_at', DB::raw("(select max(t2.updated_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
        ->groupBy('detail_products.id')
        ->skip($skip)
        ->take(5)
        ->get();
        // return $first;    
        foreach ($first as $user) {
            $user->links=DB::table('images_products')
            ->select('images_products.link')
            ->where('images_products.detail_product_id', "=", $user->id_detail_product)
            ->get();
            $user->rating = DB::table('reviews')
            ->where('reviews.detail_product_id', $user->id_detail_product)
            ->avg('rating');
        }
            

        return $first;
    }


    public function findProductName(Request $request){
        $auth = auth()->guard('api'); 
        // var_dump($request->input('cari'));
        if (!$auth->check()) {
            return response('Unauthorized.', 401);
        }else{
            $name=$request->input('find');
            $searchs = explode(' ', $name);
            foreach ($searchs as $search) {

                $first = DB::table('detail_products')
                ->join('products', 'detail_products.product_id', '=', 'products.id')
                ->join('category_products', 'products.category_id', '=', 'category_products.id')
                ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
                ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.type_product',
                'products.category_id as id_category', 'category_products.category_name', 
                'prices_products.id as id_price', 'prices_products.price')
                ->where('products.name', 'like', '%'.$search.'%')    
                // ->where('products.name', 'like', $search.'%')    
                // ->whereIn('products.name', $searchs) 
                // ->orWhereIn('type_product', $searchs) 
                ->orwhere('detail_products.type_product', '=', $search)
                ->where('prices_products.updated_at', DB::raw("(select max(t2.updated_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
                ->groupBy('detail_products.id');

            }
                $model = $first->get();
                foreach ($model as $user) {
                    $user->links=DB::table('images_products')
                    ->select('images_products.link')
                    ->where('images_products.detail_product_id', "=", $user->id_detail_product)
                    ->get();
                    $user->rating = DB::table('reviews')
                    ->where('reviews.detail_product_id', $user->id_detail_product)
                    ->avg('rating');
                }

            return $model;
        }
    }

    public function detailProduct(Request $request){
        $auth = auth()->guard('api'); 
        // var_dump($request->input('cari'));
        if (!$auth->check()) {
            return response('Unauthorized.', 401);
        }else{
            $idProduct=$request->input('id_detail');
            $first = DB::table('detail_products')
            ->join('sellers', 'detail_products.seller_id', '=', 'sellers.id')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'prices_products.detail_product_id', '=', 'detail_products.id')
            ->join('users', 'sellers.id', '=', 'users.id')
            ->select(DB::raw('DISTINCT(detail_products.id) as id_detail_product'), 'products.name as product_name', 'detail_products.type_product',
                'detail_products.description', 'detail_products.stock', 'products.category_id as id_category', 'category_products.category_name', 
                'sellers.id as id_seller', 'users.name as seller_name', 'prices_products.id as id_price', 'prices_products.price')
            ->where('detail_products.id',  $idProduct)
            ->where('prices_products.updated_at', DB::raw("(select max(t2.updated_at) from prices_products t2 where t2.detail_product_id=detail_products.id)"))
            ->groupBy('detail_products.id')
            ->get();
            foreach ($first as $user) {
                $user->links=DB::table('images_products')
                ->select('images_products.link')
                ->where('images_products.detail_product_id', "=", $user->id_detail_product)
                ->get();
                $user->rating = DB::table('reviews')
                ->where('reviews.detail_product_id', $idProduct)
                ->avg('rating');
                $user->listReview = DB::table('reviews')
                ->join('customers', 'reviews.customer_id', '=', 'customers.id')
                ->join('users', 'users.id', '=', 'customers.id')
                ->select('reviews.*', 'users.name as customer_name')
                ->where('reviews.detail_product_id', $idProduct)
                ->orderBy('reviews.created_at', 'desc')
                ->take(3)
                ->get();
            }


            return $first;
        }
    }

    public function reviewProduct(Request $request){
        $auth = auth()->guard('api'); 
        if (!$auth->check()){
            return response('Unauthorized.', 401);
        }else{  
            $id_customer = $request->input('id_customer');
            $id_detail = $request->input('id_detail');
            $rating = $request->input('rating');
            $review = $request->input('review');

            $model = DB::table('reservations')
            ->join('detail_reservations', 'detail_reservations.reservation_id', '=', 'reservations.id')
            ->select(DB::raw('DISTINCT(detail_reservations.detail_product_id) as id_detail_product'))
            ->where('reservations.customer_id', $id_customer)
            ->where('detail_reservations.detail_product_id', $id_detail)
            ->where('reservations.status', '2')
            ->get();

            if(count($model)==1){
                DB::table('reviews')->insert([
                    'customer_id' => $id_customer, 'detail_product_id' => $id_detail,
                    'rating' => $rating, 'review' => $review
                    ]);
                $response['Response'] =true;
                return $response;
            }else{
                $response['Response'] =false;
                return $response;
            }
            
        }
    }

    public function getReview(Request $request){
        $auth = auth()->guard('api'); 
        // var_dump($request->input('cari'));
        if (!$auth->check()){
            return response('Unauthorized.', 401);
        }else{
            $id_detail = $request->input('id_detail');
            $offset = $request->input('offset');

            $model = DB::table('reviews')
            ->join('customers', 'reviews.customer_id', '=', 'customers.id')
            ->join('users', 'users.id', '=', 'customers.id')
            ->select('reviews.*', 'users.name as customer_name')
            ->where('reviews.detail_product_id', $id_detail)
            ->orderBy('reviews.created_at', 'desc')
            ->skip($offset)
            ->take(5)
            ->get();
            return $model;
        }
    }


}