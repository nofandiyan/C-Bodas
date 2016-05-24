<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class KatalogController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //Domba

    public function showKatalogdomba()
    {
        return view('templates\katalogdomba'); 
    }

    //Sapi

    public function showKatalogsapi()
    {
        return view('templates\katalogsapi'); 
    }

    //Pariwisata

    public function showKatalogpariwisata()
    {
        return view('templates\katalogpariwisata'); 
    }

    //villa

    public function showKatalogvilla()
    {
        $lapaks = DB::table('detail_products')
         ->join('products', 'detail_products.product_id', '=', 'products.id')
         ->get();
         return view ('templates\katalogvilla', compact('lapaks'));
    }
}
