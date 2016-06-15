<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class CartController extends Controller
{

    public function __construct(){
   
    $this->middleware('auth');
    }

  

    public function jml(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['price'=>'required',
            'jumlah'=>'required'
            ]
        ); 

        $lala = $request->session()->push('$datacart',array(
                'price'=>$post['price'],
                'jumlah'=>$post['jumlah'],
                'total'=>$post['total']
                )
            );

        echo "<pre>";
        var_dump($lala);
        die();

    return redirect('/cart', compact('total'));
}

    public function additemsayuranorganik(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required',
            'jumlah'=>'required',
            ]
        );

           /* $datacart = array(
                'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                
                );

*/ /*var_dump($post['detailproductid']);
        die();*/
                
      
        $cart=$request->session()->get('$datacart');
        $flag=false;
        $index = 0;
        if($cart!=null)
        foreach ($cart as $c) {
                if($c['detail_product_id']==$post['detailproductid']){
                    $cart[$index]['jumlah'] = $c['jumlah']+1;
                    $request->session()->set('$datacart',$cart);
                    $flag=true;
                    break;
                }

                $index++;
                
        }
            
        if(!$flag) {
            $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price'],
                'jumlah'=>$post['jumlah']
                )
            );

        }
        
        /*$take = $request->session()->get('$datacart');
         $request->session()->put('$totaldatacart',array('take'=>$take));
            
       $taketotal =  $request->session()->get('$totaldatacart');*/

        

        /*echo "<pre>";

        var_dump();
        die();*/
      /* $dc = DB::table('cart_tmp')->insert($datacart);*/

       /*echo "<pre>";

        var_dump($dc);
        die();*/
        return redirect('/katalogsayuranorganik');
       
       /* $datacart = Input::all();
            $datacart->name=Input::get('name');
            $datacart->price=Input::get('price');
            $datacart->save();
        echo "<pre>";
        var_dump($barang);
        die();

        return Redirect::back();*/
    }


    public function additemsayurorganik(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required'
            ]
        );
        $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price']
                )
            );
        return redirect('/katalogsayurorganik');
    }


    public function additembuahanorganik(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required'
            ]
        );
        $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price']
                )
            );
        return redirect('/katalogbuahanorganik');
    }

    public function additembuahorganik(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required'
            ]
        );
        $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price']
                )
            );
        return redirect('/katalogbuahorganik');
    }

    public function additempeternakan(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required'
            ]
        );
        $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price']
                )
            );
        return redirect('/katalogpeternakan');
    }

    public function additempariwisata(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required'
            ]
        );
        $request->session()->push('$datacart',array(
            'detail_product_id'=>$post['detailproductid'],
                'price_id'=>$post['pricesproductid'],
                'name'=>$post['name'],
                'price'=>$post['price']
                )
            );
        return redirect('/katalogpariwisata');
    }

    public function addCart($prodid,$prodname,$prodpriceid){

        $cart = DB::table('carts')
        ->join('detail_products','detail_products.id','=','carts.detail_product_id')
        ->where('detail_products.id',$prodid)
        ->insert([
            'detail_product_id' => $prodid,
            'reservation_id'    => '1',
            'price_id'          => $prodpriceid,
            'amount'            => '1',
            'status'            => '0',

            ]);
        return redirect('/katalogsayuranorganik');
    }

    public function showCart(){
          $cart = DB::table('cart_tmp')
            ->join('detail_products','cart_tmp.detail_product_id','=','detail_products.id')
            ->join('prices_products', 'cart_tmp.price_id', '=', 'prices_products.id')
            ->join('products', 'detail_products.product_id', '=', 'products.id')
            ->join('category_products', 'products.category_id', '=', 'category_products.id')
            
            ->join('users', 'detail_products.seller_id', '=', 'users.id')
            ->select('detail_products.id as detailproductid','prices_products.id as pricesproductid','products.name','detail_products.description','detail_products.stock','prices_products.price','users.name AS sellername')
           // ->where('auth' )
            ->get();


        foreach ($cart as $c) {
            $c->image = DB::table('images_products')
            ->select('images_products.link','images_products.detail_product_id as idDetProdIm')
            ->where('images_products.detail_product_id','=', $c->detailproductid)
            ->get();
        }
        /*$subtotal=0;
        foreach ($cart as $c) {
            $subtotal+=$*/
            
       

        return view('templates.cart',compact('cart'));
    }
 
    public function removeItem($id){
 
        CartItem::destroy($id);
        return redirect('/cart');
    }
 
    /*public function showCheckout(){

        $alamat= DB::table('delivery_address')
        ->join('customers','delivery_address.customer.id','customers.id')
        ->join('cities','delivery_address.city_id','cities.id')
        ->select('cities.provinces')
        return view('templates.checkout');
    }*/
}	