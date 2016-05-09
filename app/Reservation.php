<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    //
    protected $fillable = array('id_reservation', 'id_customer', 'status', 'bank_name', 'bank_account', 'payment_proof', 'created_at', 'updated_at');
}