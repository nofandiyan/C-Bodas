<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images_ProductsModel extends Model
{
    protected $table = 'images_products';

    protected $fillable = [
        'detail_product_id', 'link'
    ];
}
