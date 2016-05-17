<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = array('id', 'seller_id', 'category_id', 'name', 'rating', 'description', 'stok');
}