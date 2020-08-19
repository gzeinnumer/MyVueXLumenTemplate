<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class SparePartsRelTypes extends Model 
{
    protected $table = 'spare_parts_rel_types';

    protected $fillable = [
        'spare_parts_rel_type_id', 'spare_part_id','car_type_id','created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
