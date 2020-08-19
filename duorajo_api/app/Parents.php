<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Parents extends Model 
{
    protected $table = 'parents';

    protected $fillable = [
        'parent_id', 
        'parent_name',
        'parent_address',
        'parent_photo',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        
    ];
}
