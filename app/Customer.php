<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    protected $fillable = array('id_customer', 'email', 'name', 'gender', 'address', 'zip_code', 'password', 'phone', 'status', 'confirmation_code', 'created_at', 'updated_at');
}
