<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class TransServicesDetails extends Model 
{
    protected $table = 'trans_services_details';

    protected $fillable = [
        'trans_services_detail_id', 
        'trans_service_id',
        'spare_parts_rel_type_id',
        'trans_services_detail_spart_qty',
        'trans_services_detail_spart_harga',
        'trans_services_detail_jasa',
        'trans_services_detail_jasa_qty',
        'trans_services_detail_jasa_harga',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        
    ];
}
