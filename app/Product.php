<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = array('id_product', 'id_seller', 'id_category', 'name', 'rating', 'description', 'stok');
}