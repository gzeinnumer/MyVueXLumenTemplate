<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterCode extends Model
{
    protected $table = 'trans_services_details';
    const tableName = 'Trans Services Details';

    const INSERT_SUKSES_CODE = 1;
    const INSERT_GAGAL_CODE = 0;

    const READ_SUKSES_CODE = 1;
    const READ_GAGAL_CODE = 0;

    const UPDATE_SUKSES_CODE = 1;
    const UPDATE_GAGAL_CODE = 0;

    const DELETE_SUKSES_CODE = 1;
    const DELETE_GAGAL_CODE = 0;
}

//RESOURCE
use Illuminate\Http\Resources\Json\JsonResource;
class MasterColl extends JsonResource
{
    public function toArray($request)
    {
        return [
            'trans_services_detail_id' => $this->trans_services_detail_id,
            'trans_service_id' => $this->trans_service_id,
            'spare_parts_rel_type_id' => $this->spare_parts_rel_type_id,
            'trans_services_detail_spart' => $this->trans_services_detail_spart,
            'trans_services_detail_spart_qty' => $this->trans_services_detail_spart_qty,
            'trans_services_detail_spart_harga' => $this->trans_services_detail_spart_harga,
            'trans_services_detail_jasa' => $this->trans_services_detail_jasa,
            'trans_services_detail_jasa_qty' => $this->trans_services_detail_jasa_qty,
            'trans_services_detail_jasa_harga' => $this->trans_services_detail_jasa_harga,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
            'customers_car_id' => $this->customers_car_id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer_name,
            'car_type_id' => $this->car_type_id,
            'car_type_name' => $this->car_type_name,
            'car_brand_id' => $this->car_brand_id,
            'car_brand_name' => $this->car_brand_name,
            'customers_car_ba' => $this->customers_car_ba,
            'customers_car_stnk' => $this->customers_car_stnk,
            'customers_car_rangka' => $this->customers_car_rangka,
            'customers_car_mesin' => $this->customers_car_mesin,
            'customers_car_tahun' => $this->customers_car_tahun,
            'dev_unit_id' => $this->dev_unit_id,
            'dev_unit_name' => $this->dev_unit_name,
            'parent_id' => $this->parent_id,
            'parent_name' => $this->parent_name,
        ];
    }
}

//CONTROLLER
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User as Login;
use App\TransServicesDetails as CurrentModel;

class TransServicesDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(Request $request)
    {
        $input = array(
            'user_login' => 'required|integer'
        );

        $checkUser = Login::where('id',$request->user_login)->get();

        if(count($checkUser)==0){
            return $this->onFailedFindUserLogin(MasterCode::class, $request);
        } else{
            $validator = Validator::make($request->all(), $input);

            if($validator->fails()){
                return $this->onFailedCatch(MasterCode::class,$validator->messages(), $request);
            } else{
                //ubah kodingan hanya yang ada disini ke bawah
                try {
                    $data =CurrentModel::select(
                        'trans_services_details.*',
                        'customers.customer_id',
                        'customers.customer_name',
                        'customers_cars.customers_car_id',
                        'customers_cars.customers_car_ba',
                        'customers_cars.customers_car_stnk',
                        'customers_cars.customers_car_rangka',
                        'customers_cars.customers_car_mesin',
                        'customers_cars.customers_car_tahun',
                        'car_types.car_type_id',
                        'car_types.car_type_name',
                        'car_brands.car_brand_id',
                        'car_brands.car_brand_name',
                        'dev_units.dev_unit_id',
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name'
                        )
                        ->join('trans_services','trans_services_details.trans_services_detail_id','trans_services.trans_service_id')
                        ->join('customers_cars','trans_services.customers_car_id','customers_cars.customers_car_id')
                        ->join('customers','customers_cars.customer_id','customers.customer_id')
                        ->join('car_types','customers_cars.car_type_id','car_types.car_type_id')
                        ->join('car_brands','car_types.car_brand_id','car_brands.car_brand_id')
                        ->join('dev_units','customers.dev_unit_id','dev_units.dev_unit_id')
                        ->join('parents','dev_units.parent_id','parents.parent_id')
                        ->where('trans_services_details.is_delete','0')->get();
                    if(count($data)>0){ 
                        return $this->onSuccessRead(MasterCode::class,MasterColl::collection($data), $request);
                    } else{
                        return $this->onFailedRead(MasterCode::class, $request);
                    }
                } catch (\Exception $e) {
                    return $this->onFailedCatch(MasterCode::class,$e->getMessage(), $request);
                }
                //ubah kodingan hanya yang ada disini ke atas
            }
        }
    }

    public function insert(Request $request)
    {
        $input = array(
            'user_login' => 'required|integer',
            'trans_service_id' => 'required|integer',
            'spare_parts_rel_type_id' => 'required|integer',
            'trans_services_detail_spart' => 'required|string',
            'trans_services_detail_spart_qty' => 'required|string',
            'trans_services_detail_spart_harga' => 'required|string',
            'trans_services_detail_jasa' => 'required|string',
            'trans_services_detail_jasa_qty' => 'required|string',
            'trans_services_detail_jasa_harga' => 'required|string'
        );

        $checkUser = Login::where('id',$request->user_login)->get();

        if(count($checkUser)==0){
            return $this->onFailedFindUserLogin(MasterCode::class, $request);
        } else{
            $validator = Validator::make($request->all(), $input);

            if($validator->fails()){
                return $this->onFailedCatch(MasterCode::class,$validator->messages(), $request);
            } else{
                //ubah kodingan hanya yang ada disini ke bawah
                try {
                    $model = new CurrentModel;
                    $model->trans_service_id = $request->trans_service_id;
                    $model->spare_parts_rel_type_id = $request->spare_parts_rel_type_id;
                    $model->trans_services_detail_spart = $request->trans_services_detail_spart;
                    $model->trans_services_detail_spart_qty = $request->trans_services_detail_spart_qty;
                    $model->trans_services_detail_spart_harga = $request->trans_services_detail_spart_harga;
                    $model->trans_services_detail_jasa = $request->trans_services_detail_jasa;
                    $model->trans_services_detail_jasa_qty = $request->trans_services_detail_jasa_qty;
                    $model->trans_services_detail_jasa_harga = $request->trans_services_detail_jasa_harga;
                    $model->created_by = $request->user_login;

                    if($model->save() == 1){
                        return $this->onSuccessInsert(MasterCode::class, $request);
                    } else{
                        return $this->onFailedInsert(MasterCode::class, $request);
                    }
                } catch (\Exception $e) {
                    return $this->onFailedCatch(MasterCode::class,$e->getMessage(), $request);
                }
                //ubah kodingan hanya yang ada disini ke atas
            }
        }
    }

    public function single(Request $request, $id)
    {
        $primaryKey = 'trans_services_detail_id';
        $input = array(
            'user_login' => 'required|integer'
        );

        $checkUser = Login::where('id',$request->user_login)->get();

        if(count($checkUser)==0){
            return $this->onFailedFindUserLogin(MasterCode::class, $request);
        } else{
            $validator = Validator::make($request->all(), $input);

            if($validator->fails()){
                return $this->onFailedCatch(MasterCode::class,$validator->messages(), $request);
            } else{
                //ubah kodingan hanya yang ada disini ke bawah
                try {
                    $data = CurrentModel::select(
                        'trans_services_details.*',
                        'customers.customer_id',
                        'customers.customer_name',
                        'customers_cars.customers_car_id',
                        'customers_cars.customers_car_ba',
                        'customers_cars.customers_car_stnk',
                        'customers_cars.customers_car_rangka',
                        'customers_cars.customers_car_mesin',
                        'customers_cars.customers_car_tahun',
                        'car_types.car_type_id',
                        'car_types.car_type_name',
                        'car_brands.car_brand_id',
                        'car_brands.car_brand_name',
                        'dev_units.dev_unit_id',
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name'
                        )
                        ->join('trans_services','trans_services_details.trans_services_detail_id','trans_services.trans_service_id')
                        ->join('customers_cars','trans_services.customers_car_id','customers_cars.customers_car_id')
                        ->join('customers','customers_cars.customer_id','customers.customer_id')
                        ->join('car_types','customers_cars.car_type_id','car_types.car_type_id')
                        ->join('car_brands','car_types.car_brand_id','car_brands.car_brand_id')
                        ->join('dev_units','customers.dev_unit_id','dev_units.dev_unit_id')
                        ->join('parents','dev_units.parent_id','parents.parent_id')
                        ->where($primaryKey,$id)->get();
                    if(count($data)>0){
                        return $this->onSuccessRead(MasterCode::class,MasterColl::collection($data), $request);
                    } else{
                        return $this->onFailedRead(MasterCode::class, $request);
                    }
                } catch (\Exception $e) {
                    return $this->onFailedCatch(MasterCode::class,$e->getMessage(), $request);
                }
                //ubah kodingan hanya yang ada disini ke atas
            }
        }
    }

    public function update(Request $request)
    {        
        $primaryKey = 'trans_services_detail_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer',
            'trans_service_id' => 'required|integer',
            'spare_parts_rel_type_id' => 'required|integer',
            'trans_services_detail_spart' => 'required|string',
            'trans_services_detail_spart_qty' => 'required|string',
            'trans_services_detail_spart_harga' => 'required|string',
            'trans_services_detail_jasa' => 'required|string',
            'trans_services_detail_jasa_qty' => 'required|string',
            'trans_services_detail_jasa_harga' => 'required|string'
        );
        $primaryKey_value = $request->trans_services_detail_id;
        
        $checkUser = Login::where('id',$request->user_login)->get();

        if(count($checkUser)==0){
            return $this->onFailedFindUserLogin(MasterCode::class, $request);
        } else{
            $validator = Validator::make($request->all(), $input);

            if($validator->fails()){
                return $this->onFailedCatch(MasterCode::class,$validator->messages(), $request);
            } else{
                //ubah kodingan hanya yang ada disini ke bawah
                try {
                    $d = array(
                        'trans_service_id' => $request->trans_service_id,
                        'spare_parts_rel_type_id' => $request->spare_parts_rel_type_id,
                        'trans_services_detail_spart' => $request->trans_services_detail_spart,
                        'trans_services_detail_spart_qty' => $request->trans_services_detail_spart_qty,
                        'trans_services_detail_spart_harga' => $request->trans_services_detail_spart_harga,
                        'trans_services_detail_jasa' => $request->trans_services_detail_jasa,
                        'trans_services_detail_jasa_qty' => $request->trans_services_detail_jasa_qty,
                        'trans_services_detail_jasa_harga' => $request->trans_services_detail_jasa_harga,
                        'updated_by' => $request->user_login
                    );
                    $data = CurrentModel::where($primaryKey, $primaryKey_value)->update($d);
                    if($data){
                        return $this->onSuccessUpdate(MasterCode::class, $request);
                    } else{
                        return $this->onFailedUpdate(MasterCode::class, $request);
                    }
                } catch (\Exception $e) {
                    return $this->onFailedCatch(MasterCode::class,$e->getMessage(), $request);    
                }
                //ubah kodingan hanya yang ada disini ke atas
            }
        }
    }
    
    public function delete(Request $request)
    {
        $primaryKey = 'trans_services_detail_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer'
        );
        $primaryKey_value = $request->trans_services_detail_id;

        $checkUser = Login::where('id',$request->user_login)->get();

        if(count($checkUser)==0){
            return $this->onFailedFindUserLogin(MasterCode::class, $request);
        } else{
            $validator = Validator::make($request->all(), $input);

            if($validator->fails()){
                return $this->onFailedCatch(MasterCode::class,$validator->messages(), $request);
            } else{
                //ubah kodingan hanya yang ada disini ke bawah
                try {
                    $d = array(
                        'is_delete' => '1',
                        'updated_by' => $request->user_login
                    );
                    $data = CurrentModel::where($primaryKey, $primaryKey_value)->update($d);
                    if($data){
                        return $this->onSuccessDelete(MasterCode::class, $request);
                    } else{
                        return $this->onFailedDelete(MasterCode::class, $request);
                    }
                } catch (\Exception $e) {
                    return $this->onFailedCatch(MasterCode::class,$e->getMessage(), $request);    
                }
                //ubah kodingan hanya yang ada disini ke atas
            }
        }
    }
}