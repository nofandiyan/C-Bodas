<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SellerModel;

use App\Reservation;

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

     public function addhome(Request $request){
       $post=$request->all();
       $v=\Validator::make($request->all(),
        ['detailproductid'=>'required',
        'pricesproductid'=>'required',
        'name'=>'required',
        'price'=>'required',
        'jumlah'=>'required',
        'category_id'=>'required'
        ]
        );                
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
                'jumlah'=>$post['jumlah'],
                'category_id'=>$post['category_id']
                )
            );

        }
        return redirect('/');
    }

    public function additemsayuranorganik(Request $request){
       $post=$request->all();
       $v=\Validator::make($request->all(),
        ['detailproductid'=>'required',
        'pricesproductid'=>'required',
        'name'=>'required',
        'price'=>'required',
        'jumlah'=>'required',
        'category_id'=>'required'
        ]
        );                

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
                'jumlah'=>$post['jumlah'],
                'category_id'=>$post['category_id']
                )
            );

        }
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
    public function addsingleproduct(Request $request){
       $post=$request->all();
       $v=\Validator::make($request->all(),
        ['detailproductid'=>'required',
        'pricesproductid'=>'required',
        'name'=>'required',
        'price'=>'required',
        'jumlah'=>'required',
        'category_id'=>'required'
        ]
        );                

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
                'jumlah'=>$post['jumlah'],
                'category_id'=>$post['category_id']
                )
            );

        }
        return redirect('/katalogsayurorganik');
    }

    public function additemsayurorganik(Request $request){
       $post=$request->all();
       $v=\Validator::make($request->all(),
        ['detailproductid'=>'required',
        'pricesproductid'=>'required',
        'name'=>'required',
        'price'=>'required',
        'jumlah'=>'required',
        'category_id'=>'required'
        ]
        );                

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
                'jumlah'=>$post['jumlah'],
                'category_id'=>$post['category_id']
                )
            );

        }
        return redirect('/katalogsayurorganik');
    }


    public function additembuahanorganik(Request $request){
        $post=$request->all();
        $v=\Validator::make($request->all(),
            ['detailproductid'=>'required',
            'pricesproductid'=>'required',
            'name'=>'required',
            'price'=>'required',
            'jumlah'=>'required',
            'category_id'=>'required'
            ]
            );                
        
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
                    'jumlah'=>$post['jumlah'],
                    'category_id'=>$post['category_id']
                    )
                );

            }
            return redirect('/katalogbuahanorganik');
        }

        public function additembuahorganik(Request $request){
            $post=$request->all();
            $v=\Validator::make($request->all(),
                ['detailproductid'=>'required',
                'pricesproductid'=>'required',
                'name'=>'required',
                'price'=>'required',
                'jumlah'=>'required',
                ]
                );                
            
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
                        'jumlah'=>$post['jumlah'],
                        'category_id'=>$post['category_id']
                        )
                    );

                }
                return redirect('/katalogbuahorganik');
            }

            public function additempeternakan(Request $request){
               $post=$request->all();
               $v=\Validator::make($request->all(),
                ['detailproductid'=>'required',
                'pricesproductid'=>'required',
                'name'=>'required',
                'price'=>'required',
                'jumlah'=>'required',
                'category_id'=>'required'
                ]
                );                

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
                        'jumlah'=>$post['jumlah'],
                        'category_id'=>$post['category_id']
                        )
                    );

                }
                return redirect('/katalogpeternakan');
            }

            public function additempariwisata(Request $request){
               $post=$request->all();
               $v=\Validator::make($request->all(),
                ['detailproductid'=>'required',
                'pricesproductid'=>'required',
                'name'=>'required',
                'price'=>'required',
                'jumlah'=>'required',
                'category_id'=>'required'
                ]
                );                

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
                        'jumlah'=>$post['jumlah'],
                        'category_id'=>$post['category_id']
                        )
                    );

                }
                return redirect('/katalogpariwisata');
            }

            public function additemsearch(Request $request){
                $post=$request->all();
                $v=\Validator::make($request->all(),
                    ['detailproductid'=>'required',
                    'pricesproductid'=>'required',
                    'name'=>'required',
                    'price'=>'required',
                    'jumlah'=>'required',
                    'category_id'=>'required'
                    ]
                    );                
                
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
                            'jumlah'=>$post['jumlah'],
                            'category_id'=>$post['category_id']
                            )
                        );

                    }
                    return redirect('/searchresult');
                }

                public function additemsingleproduct(Request $request){
                    $post=$request->all();
                    $v=\Validator::make($request->all(),
                        ['detailproductid'=>'required',
                        'pricesproductid'=>'required',
                        'name'=>'required',
                        'price'=>'required',
                        'jumlah'=>'required',
                        'category_id'=>'required'
                        ]
                        );                
                    
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
                                'jumlah'=>$post['jumlah'],
                                'category_id'=>$post['category_id']
                                )
                            );
                            
                        }
                        return redirect('/single-product/'.$post['detailproductid']);
                    }


                    public function removeItem(Request $request){
                     $post=$request->all();
                     $cart=$request->session()->get('$datacart');
                     $index = 0;

                     if($cart!=null)
                        foreach ($cart as $c) {
                            if($c['detail_product_id']==$post['detailproductid']){
                                unset($cart[$index]);
                                $request->session()->set('$datacart',$cart);
                                $flag=true;
                                break;
                            }

                            $index++;
                            
                        }
                        
                        return redirect('/cart');
                    }

                    public function order(){

                        $customer = DB::table('customers')->where('id', Auth::user()->id)->value('id');   
                        $informasi = DB::table('users')

                        ->join('cities','users.city_id','=','cities.id')
                        ->join('provinces','cities.province_id','=','provinces.id')
                        ->select('users.street','users.name','users.zip_code','cities.city','users.phone','provinces.province','cities.province_id','users.city_id', 'cities.type','users.id as customer_id')
                        ->where('users.id','=',$customer)
                        ->first();

                        $province = DB::table('provinces')
                        ->select('provinces.id', 'provinces.province')
                        ->get();

                        $cities = DB::table('cities')
                        ->join('provinces','cities.province_id','=','provinces.id')
                        ->select('cities.id','cities.city','cities.province_id', 'cities.type','provinces.province')
                        ->get();
         // dd($cities);
                        

                        return view ('templates.checkout',compact('informasi','province','cities'));
                    }

                    public function addalamatbaru(){
                       $pengiriman= DB::table('delivery_address')
                       ->insert([
                        'customer_id'   => auth()->user()->id,
                        'city_id'       => Input::get('city_id'),
                        'name'          => Input::get('name'),
                        'phone'         => Input::get('phone'),
                        'street'        => Input::get('street'),
                        'zip_code'      => Input::get('zip_code'),
                        'created_at'    => Carbon::now()    
                        ]);

                       return redirect('/checkout-shipping');
                   }

                   public function addalamatlama(){
              
                    $pengiriman= DB::table('delivery_address')
                    ->insert([
                        'customer_id'   => auth()->user()->id,
                        'city_id'       => Input::get('city_id'),
                        'name'          => Input::get('name'),
                        'phone'         => Input::get('phone'),
                        'street'        => Input::get('street'),
                        'zip_code'      => Input::get('zip_code'),
                        'created_at'    => Carbon::now() 

                        ]);

                    return redirect('/checkout-shipping');
                }


                public function showcheckoutreview(){
                    return view('templates.checkout-review');
                }

                public function postcart(Request $request){
                $customer = DB::table('customers')->where('id', Auth::user()->id)->value('id'); 
                $delivery= DB::table('delivery_address')
                    ->join('customers','delivery_address.customer_id', '=', 'customers.id')
                    ->join('cities','delivery_address.city_id','=','cities.id')
                    ->select('customers.id','cities.province_id','cities.id as city_id','delivery_address.created_at','delivery_address.id as delivid')
                    ->where('customers.id', '=' , $customer )
                    ->orderby ('created_at', 'DESC')
                    ->first(); 

                $post=$request->all();
                $bank=$request->session()->get('$databank');
                $hargaongkir=$request->session()->get('$ongkir');
                $cart=$request->session()->get('$datacart');
                $reservasi=Reservation::create([
                        'customer_id'             => auth()->user()->id,
                        'delivery_id'     => $delivery->delivid,
                        'bank_name'               => $bank['bank_name'], 
                        'bank_account'            => $bank['bank_account']
                        ]);

                foreach ($cart as $c){
                $pengiriman= DB::table('detail_reservations')
                    ->insert([
                        'detail_product_id'     => $c['detail_product_id'],
                        'price_id'              => $c['price_id'],
                        'amount'                => $c['jumlah'],
                        'delivery_cost'         => $hargaongkir['harga_ongkir'],
                        'created_at'            => Carbon::now(), 
                        'reservation_id'        => $reservasi->id
                        ]);
                }    
                    return view('templates.ordercomplete');
                }

}	