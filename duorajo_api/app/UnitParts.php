<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class UnitParts extends Model 
{
    protected $table = 'unit_parts';

    protected $fillable = [
        'unit_part_id', 'unit_part_name','created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
