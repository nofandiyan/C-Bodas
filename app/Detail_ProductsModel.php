<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_ProductsModel extends Model
{
    protected $table = 'detail_products';

    protected $fillable = [
        'product_id', 'seller_id', 'rating', 'stock', 'description'
    ];
}
