<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterCode extends Model
{
    protected $table = 'car_types';
    const tableName = 'Car Types';

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
            'car_type_id' => $this->car_type_id,
            'car_brand_id' => $this->car_brand_id,
            'car_type_name' => $this->car_type_name,
            'car_type_year' => $this->car_type_year,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
            'car_brand_name' => $this->car_brand_name,
        ];
    }
}

//CONTROLLER
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User as Login;
use App\CarTypes as CurrentModel;

class CarTypesController extends Controller
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
                    $data =CurrentModel::select('car_types.*', 'car_brands.car_brand_name')
                        ->join('car_brands','car_types.car_brand_id','car_brands.car_brand_id')
                        ->where('car_types.is_delete','0')
                        ->get();
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
            'car_brand_id' => 'required|integer',
            'car_type_name' => 'required|string',
            'car_type_year' => 'required|string'
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
                    $model->car_brand_id = $request->car_brand_id;
                    $model->car_type_name = $request->car_type_name;
                    $model->car_type_year = $request->car_type_year;
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
        $primaryKey = 'car_type_id';
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
                    $data = CurrentModel::select('car_types.*', 'car_brands.car_brand_name')
                        ->join('car_brands','car_types.car_brand_id','car_brands.car_brand_id')
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
        $primaryKey = 'car_type_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer',
            'car_brand_id' => 'required|integer',
            'car_type_name' => 'required|string',
            'car_type_year' => 'required|string'
        );

        $primaryKey_value = $request->car_type_id;
        
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
                        'car_brand_id' => $request->car_brand_id,
                        'car_type_name' => $request->car_type_name,
                        'car_type_year' => $request->car_type_year,
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
        $primaryKey = 'car_type_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer'
        );
        $primaryKey_value = $request->car_type_id;

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