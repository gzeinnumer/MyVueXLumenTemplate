<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterCode extends Model
{
    protected $table = 'customer';
    const tableName = 'Customer';

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
            'customer_id' => $this->customer_id,
            'dev_unit_id' => $this->dev_unit_id ,
            'customer_name' => $this->customer_name,
            'customer_address' => $this->customer_address,
            'customer_no_hp' => $this->customer_no_hp,
            'customer_ktp_nik' => $this->customer_ktp_nik,
            'customer_ktp_foto' => $this->customer_ktp_foto,
            'customer_ktp_bday' => $this->customer_ktp_bday,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
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
use App\Customers as CurrentModel;

class CustomersController extends Controller
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
                        'customers.*', 
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name'
                        )
                        ->join('dev_units','customers.dev_unit_id','dev_units.dev_unit_id')
                        ->join('parents','dev_units.parent_id','parents.parent_id')
                        ->where('customers.is_delete','0')->get();
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
            'dev_unit_id' => 'required|integer',
            'customer_name' => 'required|string',
            'customer_address' => 'required|string',
            'customer_no_hp' => 'required|string',
            'customer_ktp_nik' => 'required|string',
            'customer_ktp_foto' => 'required|string',
            'customer_ktp_bday' => 'required|string'
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
                    $model->dev_unit_id = $request->dev_unit_id;
                    $model->customer_name = $request->customer_name;
                    $model->customer_address = $request->customer_address;
                    $model->customer_no_hp = $request->customer_no_hp;
                    $model->customer_ktp_nik = $request->customer_ktp_nik;
                    $model->customer_ktp_foto = $request->customer_ktp_foto;
                    $model->customer_ktp_bday = $request->customer_ktp_bday;
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
        $primaryKey = 'customer_id';
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
                        'customers.*', 
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name'
                        )
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
        $primaryKey = 'customer_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer',
            'dev_unit_id' => 'required|integer',
            'customer_name' => 'required|string',
            'customer_address' => 'required|string',
            'customer_no_hp' => 'required|string',
            'customer_ktp_nik' => 'required|string',
            'customer_ktp_foto' => 'required|string',
            'customer_ktp_bday' => 'required|string'
        );
        $primaryKey_value = $request->customer_id;
        
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
                        'dev_unit_id' => $request->dev_unit_id,
                        'customer_name' => $request->customer_name,
                        'customer_address' => $request->customer_address,
                        'customer_no_hp' => $request->customer_no_hp,
                        'customer_ktp_nik' => $request->customer_ktp_nik,
                        'customer_ktp_foto' => $request->customer_ktp_foto,
                        'customer_ktp_bday' => $request->customer_ktp_bday,
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
        $primaryKey = 'customer_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer'
        );
        $primaryKey_value = $request->customer_id;

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