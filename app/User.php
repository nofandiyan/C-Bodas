<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = 
         array('id', 'email', 'name', 'gender', 'street', 'city', 'province', 'zip_code', 'password', 'phone', 'status', 'confirmation_code', 
        'created_at', 'updated_at', 'api_token', 'role' );
    
=======
    protected $fillable = [
        // 'id', 'email', 'name', 'gender', 'street', 'city', 'province', 'zip_code', 'password', 'phone', 'status', 'confirmation_code', 'created_at', 'updated_at', 'api_token'
        'name', 'email', 'password', 'street', 'city', 'province', 'zip_code', 'phone', 'status', 'confirmation_code', 'role'

    ];
>>>>>>> e2f863b6883bc5c219d53c9cac0c0178bce68fea

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
