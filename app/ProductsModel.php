<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id', 'name'
    ];
}
