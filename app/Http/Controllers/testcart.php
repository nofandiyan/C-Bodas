<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\User;

use DB;

use Auth;

use Illuminate\Support\Facades\Input as Input;

class testcart extends Controller
{
    public function a(Request $request){
       
       	$post = $request->all();

        $cart=$request->session()->get('$datacart');
        $jumlah=0;
        foreach ($cart as $c) {
      
        	$harga=$c['price'];
        	$jumlah=$c['jumlah'];
        	$total=$harga*$jumlah;
        }
       

       /* $cart=$take;*/
    return view('templates.cart',compact('cart','total','jumlah'));

    }

    public function b(Request $request){
       
        $take=$request->session()->get('$datacart');
        $cart=$take;
       /* echo "<pre>";

        var_dump($cart);
        die();*/

    return view('templates.cartsub',compact('cart'));

    }


    
   
}	