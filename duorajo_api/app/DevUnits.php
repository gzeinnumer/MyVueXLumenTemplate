<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class DevUnits extends Model 
{
    protected $table = 'dev_units';

    protected $fillable = [
        'dev_unit_id',
        'parent_id', 
        'dev_unit_name',
        'dev_unit_address',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        
    ];
}
