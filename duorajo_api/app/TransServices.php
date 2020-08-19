<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class TransServices extends Model 
{
    protected $table = 'trans_services';

    protected $fillable = [
        'trans_service_id', 
        'customers_car_id',
        'trans_service_date_start',
        'trans_service_date_done',
        'trans_service_date_next',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        
    ];
}
