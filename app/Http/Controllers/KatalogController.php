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
        ->select('detail_products.id ','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
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
        ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id','detail_products.type_product')
        ->where('category_id', '=' , 2 )
        ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }

        foreach ($barang as $rev) {
            $rev = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
            ->where('reviews.detail_product_id','=', $rev->detailproductid)
            ->get();

            $i=0;
            $sumRat=0;
            foreach ($rev as $re) {
                $sumRat += $re->rating;
                $i++;
            }

            if ($i == 0) {
                $avgRat = $sumRat;
            }else{
                $avgRat = $sumRat/$i;
            }
        } 


        return view('templates.katalogpeternakan', compact('barang','reviews','avgRat')); 
    }



    //sayur organik
    public function showSayurorganik()
    {
        $barang = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
        ->join('users', 'detail_products.seller_id', '=', 'users.id')
        ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id','detail_products.type_product')
        ->where('type_product', '=' , 'Sayur Organik' )
        ->paginate(9);


        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }


        foreach ($barang as $rev) {
            $rev = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
            ->where('reviews.detail_product_id','=', $rev->detailproductid)
            ->get();

            $i=0;
            $sumRat=0;
            foreach ($rev as $re) {
                $sumRat += $re->rating;
                $i++;
            }

            if ($i == 0) {
                $avgRat = $sumRat;
            }else{
                $avgRat = $sumRat/$i;
            }
        } 

        
        return view('templates.katalogsayurorganik', compact('barang','reviews','avgRat')); 
    }

    //sayur anorganik
    public function showSayuranorganik()
    {
        $barang = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
        ->join('users', 'detail_products.seller_id', '=', 'users.id')
        ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id','detail_products.type_product')
        ->where('type_product', '=' , 'Sayur Anorganik' )
        ->paginate(9);

        
        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }
        
        foreach ($barang as $rev) {
            $rev = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
            ->where('reviews.detail_product_id','=', $rev->detailproductid)
            ->get();

            $i=0;
            $sumRat=0;
            foreach ($rev as $re) {
                $sumRat += $re->rating;
                $i++;
            }

            if ($i == 0) {
                $avgRat = $sumRat;
            }else{
                $avgRat = $sumRat/$i;
            }
        } 


        return view('templates.katalogsayuranorganik', compact('barang','reviews','avgRat')); 
    }

    //buah organik
    public function showBuahorganik()
    {
      

       $barang = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
        ->join('users', 'detail_products.seller_id', '=', 'users.id')
        ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id','detail_products.type_product')
        ->where('type_product', '=' , 'Buah Organik' )
        ->paginate(9);


        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }
        
        foreach ($barang as $rev) {
            $rev = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
            ->where('reviews.detail_product_id','=', $rev->detailproductid)
            ->get();

            $i=0;
            $sumRat=0;
            foreach ($rev as $re) {
                $sumRat += $re->rating;
                $i++;
            }

            if ($i == 0) {
                $avgRat = $sumRat;
            }else{
                $avgRat = $sumRat/$i;
            }
        } 

        return view('templates.katalogbuahorganik', compact('barang','total','reviews','avgRat')); 
    }

    //buah anorganik
    public function showBuahanorganik()
    {
        $barang = DB::table('detail_products')
        ->join('products', 'detail_products.product_id', '=', 'products.id')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
        ->join('users', 'detail_products.seller_id', '=', 'users.id')
        ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id','detail_products.type_product')
        ->where('type_product', '=' , 'Buah Anorganik' )
        ->paginate(9);

        foreach ($barang as $bar) {
            $bar->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $bar->detailproductid)
            ->get();
        }


        foreach ($barang as $rev) {
            $rev = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
            ->where('reviews.detail_product_id','=', $rev->detailproductid)
            ->get();

            $i=0;
            $sumRat=0;
            foreach ($rev as $re) {
                $sumRat += $re->rating;
                $i++;
            }

            if ($i == 0) {
                $avgRat = $sumRat;
            }else{
                $avgRat = $sumRat/$i;
            }
        } 

        return view('templates.katalogbuahanorganik', compact('barang','reviews','avgRat')); 
    }

    
    //Pariwisata

    public function showKatalogpariwisata()
    {
     $barang = DB::table('detail_products')
     ->join('products', 'detail_products.product_id', '=', 'products.id')
     ->join('category_products', 'products.category_id', '=', 'category_products.id')
     ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
     ->join('users', 'detail_products.seller_id', '=', 'users.id')
     ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername', 'category_products.id as category_id')
     ->where('category_id', '=' , 3 )
     ->paginate(9);

     foreach ($barang as $bar) {
        $bar->image = DB::table('images_products')
        ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
        ->where('images_products.detail_product_id','=', $bar->detailproductid)
        ->get();
    }

    foreach ($barang as $rev) {
        $rev = DB::table('reviews')
        ->join('users','users.id','=','reviews.customer_id')
        ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
        ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
        ->where('reviews.detail_product_id','=', $rev->detailproductid)
        ->get();

        $i=0;
        $sumRat=0;
        foreach ($rev as $re) {
            $sumRat += $re->rating;
            $i++;
        }

        if ($i == 0) {
            $avgRat = $sumRat;
        }else{
            $avgRat = $sumRat/$i;
        }
    } 

    return view('templates.katalogpariwisata', compact('barang','reviews','avgRat')); 
}

public function showSingleproduct($detailproductid)
{

    $product = DB::table('detail_products')
    ->join('products', 'detail_products.product_id', '=', 'products.id')
    ->join('category_products', 'products.category_id', '=', 'category_products.id')
    ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
    ->select('detail_products.id as detailproductid', 'detail_products.seller_id', 'detail_products.created_at', 'detail_products.updated_at', 'products.name','products.category_id','detail_products.description','products.name','detail_products.stock','prices_products.price','detail_products.type_product', 'category_products.id as category_id','detail_products.type_product')
    ->where('detail_products.id', '=', $detailproductid)
    ->first();

    if (count($product) == 0) {
        return redirect('/');
    }

    $images = DB::table('images_products')
    ->where('detail_product_id', '=', $detailproductid)
    ->get();

    $price = DB::table('prices_products')
    ->orderBy('id','desc')
    ->where('detail_product_id', '=', $detailproductid)
    ->first();

            // echo("<pre>");
            // var_dump($sold);
            // die();

    $reviews = DB::table('reviews')
    ->join('users','users.id','=','reviews.customer_id')
    ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
    ->where('reviews.detail_product_id',$detailproductid)
    ->select('reviews.id as idRev','users.name as custName','reviews.detail_product_id as detId','reviews.rating','reviews.review','reviews.created_at')
    ->get();

    $i=0;
    $sumRat=0;
    foreach ($reviews as $rev) {
        $sumRat += $rev->rating;
        $i++;
    }

    if ($i == 0) {
        $avgRat = $sumRat;
    }else{
        $avgRat = $sumRat/$i;
    }

    
    

    return view('templates.single-product', compact('product','images','price','reviews','avgRat'));
    
}

    /*public function inputreview(Request $request)
    {
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'customer_id'=>'required',
            'review'=>'required',
            'rating'=>'required'
            ]
        );

           $datareview = array(
                'detail_product_id'=>$post['detailproductid'],
                'customer_id'=>$post['customerid'],
                'review'=>$post['review'],
                'rating' =>$post['rating']
                );

       
        die();
    return redirect('/reviewproduct')    

}*/


    /* public function detailProductSayurorganik($){
       


        $product = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id as id', 'detail_products.seller_id', 'detail_products.created_at', 'detail_products.updated_at', 'products.name','products.category_id','detail_products.description','detail_products.stock','prices_products.price','detail_products.type_product')
            ->where('detail_products.id', '=', $id)
            ->first();

        if (count($product) == 0) {
            return redirect('/');
        }

        $images = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();

        $price = DB::table('prices_products')
            ->orderBy('id','desc')
            ->where('detail_product_id', '=', $id)
            ->first();  
        
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

            return view('templates.single-product',compactcompact('product','images','price','reviews','avgRat'));
        
        }*/
    }
