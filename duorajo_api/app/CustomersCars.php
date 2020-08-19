<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class CustomersCars extends Model 
{
    protected $table = 'customers_cars';

    protected $fillable = [
        'customers_car_id', 
        'customer_id',
        'car_type_id',
        'customers_car_ba',
        'customers_car_stnk',
        'customers_car_stnk_foto',
        'customers_car_rangka',
        'customers_car_mesin',
        'customers_car_tahun',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        
    ];
}
