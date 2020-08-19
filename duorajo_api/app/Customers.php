<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Customers extends Model 
{
    protected $table = 'customers';

    protected $fillable = [
        'customer_id', 'dev_unit_id','customer_name','customer_address','customer_no_hp','customer_ktp_nik','customer_ktp_foto','customer_ktp_bday','created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
