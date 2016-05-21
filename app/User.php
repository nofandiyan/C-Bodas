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
    protected $fillable = [
        // 'id', 'email', 'name', 'gender', 'street', 'city', 'province', 'zip_code', 'password', 'phone', 'status', 'confirmation_code', 'created_at', 'updated_at', 'api_token'
        'name', 'email', 'password', 'street', 'city', 'province', 'zip_code', 'phone', 'status', 'confirmation_code', 'role'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
