<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_ProductsModel extends Model
{
    protected $table = 'category_products';

    protected $fillable = [
        'category_name'
    ];
}
