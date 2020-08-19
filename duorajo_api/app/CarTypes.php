<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class CarTypes extends Model 
{
    protected $table = 'car_types';

    protected $fillable = [
        'car_type_id','car_brand_id', 'car_type_name','car_type_year','created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
