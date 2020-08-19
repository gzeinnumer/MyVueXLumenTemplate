<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class CarBrands extends Model 
{
    protected $table = 'car_brands';

    protected $fillable = [
        'car_brand_id', 'car_brand_name','created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
