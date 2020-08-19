<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class SpareParts extends Model 
{
    protected $table = 'spare_parts';

    protected $fillable = [
        'spare_part_id', 'dev_unit_id','unit_part_id','spare_part_name',
        'spare_part_harga_awal', 'spare_part_harga_jual','spare_part_stock','spare_part_sold',

        'created_by','updated_by'
    ];

    protected $hidden = [
        
    ];
}
