<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    protected $fillable = array('id', 'email', 'name', 'gender', 'street', 'city', 'province', 'zip_code', 'password', 'phone', 'status', 'confirmation_code', 'created_at', 'updated_at');
}
