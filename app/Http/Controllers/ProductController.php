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

use Carbon\Carbon;

// use Validator;

use DB;

use Auth;

use App\Quotation;

use Illuminate\Support\Facades\Input as Input;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        
            return redirect('/');
        
    }

    public function createTani()
    {
        if (Auth::user()->role=='seller') {
            return view('product.createTani');
        }else{
            return redirect('/');
        }
    }
    public function createTernak()
    {
        if (Auth::user()->role=='seller') {
            return view('product.createTernak');
        }else{
            return redirect('/');
        }
    }
    public function createWisata()
    {
        if (Auth::user()->role=='seller') {
            return view('product.createWisata');
        }else{
            return redirect('/');
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'          => 'required',
            'description'   => 'required',
            
            'foto1'         => 'required|mimes:jpeg,png',
            'foto2'         => 'required|mimes:jpeg,png',
            'foto3'         => 'required|mimes:jpeg,png',
            'foto4'         => 'required|mimes:jpeg,png',
            'stock'         => 'required',
            'price'         => 'required'

        ]);

        $product = new ProductsModel;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;


        $product->save();

        $seller = DB::table('sellers')->where('id', Auth::user()->id)->value('id');

        $detail = new Detail_ProductsModel;
        $detail->product_id     = $product->id;
        $detail->seller_id      = $seller;
        $detail->stock          = $request->stock;
        $detail->description    = $request->description;
        $detail->type_product   = $request->type_product;
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
                
                $file->move(base_path().'/public/images/product/', $filename);
                
                $images = new Images_ProductsModel;
                $images->detail_product_id   = $detail->id;
                $images->link                = 'images/product/'.$filename;
                $images->save();
            }
        }

        return redirect('/');
    }

    public function show($id)
    {

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

            // echo("<pre>");
            // var_dump($sold);
            // die();

        $reviews = DB::table('reviews')
            ->join('users','users.id','=','reviews.customer_id')
            ->join('detail_products','reviews.detail_product_id','=','detail_products.id')
            ->where('reviews.detail_product_id',$id)
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
        

        return view('product.viewProduct', compact('product','images','price','reviews','avgRat'));
        
    }

    public function edit($id)
    {
        $product = DB::table('detail_products')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->join('prices_products', 'detail_products.id', '=', 'prices_products.detail_product_id')
            ->select('detail_products.id','products.name','products.category_id','detail_products.description','detail_products.stock','prices_products.price','detail_products.type_product')
            ->where('detail_products.id', '=', $id)
            ->first();

        if (count($product) == 0) {
            return redirect('/');
        }

        $images = DB::table('images_products')
            ->where('detail_product_id', '=', $id)
            ->get();

        $prices = DB::table('prices_products')
            ->orderBy('id','desc')
            ->where('detail_product_id', '=', $id)
            ->first();
        
        if (Auth::user()->role=='seller') {
            return view('product.editProduct', compact('product', 'images', 'prices'));
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $dt = Carbon::now();
        $dt->tz('America/Toronto')->setTimezone('Asia/Jakarta');
        $now = $dt->toDateTimeString();

        $this->validate($request, [
            'name'          => 'required',
            'description'   => 'required',
            'stock'         => 'required',
            'price'         => 'required'
        ]);

        $detail = Detail_ProductsModel::find($id);
        $detail->description    = $request->description;
        $detail->stock          = $request->stock;
        // $detail->type_product   = $request->type_product;

        $detail->save();

        $product = DB::table('products')
            ->where('products.id','=',$detail->product_id)
            ->update([
                'name' => Input::get('name')
            ]);

        $price = DB::table('prices_products')
            ->orderBy('id', 'desc')
            ->where('prices_products.detail_product_id','=',$detail->id)
            ->select('prices_products.price')
            ->first();

        if ($price->price != $request->price) {
            DB::table('prices_products')
            ->insert([
                'detail_product_id' => $detail->id,
                'price' => Input::get('price'),
                'created_at' => $now,
                'updated_at' => $now
                ]);
        }

        $files = [];
        if ($request->file('foto1')) $files[] = $request->file('foto1');
        if ($request->file('foto2')) $files[] = $request->file('foto2');
        if ($request->file('foto3')) $files[] = $request->file('foto3');
        if ($request->file('foto4')) $files[] = $request->file('foto4');

        $category = DB::table('detail_products')
            ->where('detail_products.id','=',$detail->id)
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            ->select('products.category_id','category_products.category_name')
            ->get();

        foreach ($files as $file)
        {
            if ($request->hasFile('foto1')) {
                $filename=$detail->id.'-'.$category[0]->category_id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/product/', $filename);

                $images = DB::table('images_products')
                    ->where('images_products.id','=', $request->idImage1)
                    ->update([
                        'link' => 'images/product/'.$filename
                    ]);
            }elseif ($request->hasFile('foto2')) {
                $filename=$detail->id.'-'.$category[0]->category_id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/product/', $filename);

                $images = DB::table('images_products')
                    ->where('images_products.id','=', $request->idImage2)
                    ->update([
                        'link' => 'images/product/'.$filename
                    ]);
            }elseif ($request->hasFile('foto3')) {
                $filename=$detail->id.'-'.$category[0]->category_id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/product/', $filename);

                $images = DB::table('images_products')
                    ->where('images_products.id','=', $request->idImage3)
                    ->update([
                        'link' => 'images/product/'.$filename
                    ]);
            }elseif ($request->hasFile('foto4')) {
                $filename=$detail->id.'-'.$category[0]->category_id.'-'.$file->getClientOriginalName();
                    
                $file->move(base_path().'/public/images/product/', $filename);

                $images = DB::table('images_products')
                    ->where('images_products.id','=', $request->idImage4)
                    ->update([
                        'link' => 'images/product/'.$filename
                    ]);
            }
        }
        return redirect('/Product/'.$id);
    }



    public function destroy($id)
    {

        //
    }
}
