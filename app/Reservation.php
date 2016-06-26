<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    //
	protected $table = 'reservations';

    protected $fillable = array('id', 'customer_id', 'delivery_id', 'status', 'bank_name', 'bank_account', 'payment_proof', 'created_at', 'updated_at');
}