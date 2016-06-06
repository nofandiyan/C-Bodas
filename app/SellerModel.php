<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerModel extends Model
{
    protected $table = 'sellers';

    protected $fillable = [
        'type_id', 'no_id', 'bank_account', 'account_number', 'bank_name', 'prof_pic'
    ];
}
