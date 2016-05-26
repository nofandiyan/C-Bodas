<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices_ProductsModel extends Model
{
    protected $table = 'prices_products';

    protected $fillable = [
        'detail_product_id', 'price', 'created_at', 'updated_at'
    ];
}
