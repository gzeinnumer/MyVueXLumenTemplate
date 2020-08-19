<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterCode extends Model
{
    protected $table = 'spare_parts';
    const tableName = 'Spare Parts';

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
            'spare_part_id' => $this->spare_part_id,
            'dev_unit_id' => $this->dev_unit_id,
            'unit_part_id' => $this->unit_part_id,
            'spare_part_name' => $this->spare_part_name,
            'spare_part_harga_awal' => $this->spare_part_harga_awal,
            'spare_part_harga_jual' => $this->spare_part_harga_jual,
            'spare_part_stock' => $this->spare_part_stock,
            'spare_part_sold' => $this->spare_part_sold,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
            'dev_unit_name' => $this->dev_unit_name,
            'parent_id' => $this->parent_id,
            'parent_name' => $this->parent_name,
            'unit_part_name' => $this->unit_part_name,
        ];
    }
}

//CONTROLLER
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User as Login;
use App\SpareParts as CurrentModel;

class SparePartsController extends Controller
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
                        'spare_parts.*',
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name',
                        'unit_parts.unit_part_name'
                        )
                        ->join('dev_units','spare_parts.dev_unit_id','dev_units.dev_unit_id')
                        ->join('parents','dev_units.parent_id','parents.parent_id')
                        ->join('unit_parts','spare_parts.unit_part_id','unit_parts.unit_part_id')
                        ->where('spare_parts.is_delete','0')->get();
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
            'unit_part_id' => 'required|integer',
            'spare_part_name' => 'required|string',
            'spare_part_harga_awal' => 'required|string',
            'spare_part_harga_jual' => 'required|string',
            'spare_part_stock' => 'required|string',
            'spare_part_sold' => 'required|string'
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
                    $model->unit_part_id = $request->unit_part_id;
                    $model->spare_part_name = $request->spare_part_name;
                    $model->spare_part_harga_awal = $request->spare_part_harga_awal;
                    $model->spare_part_harga_jual = $request->spare_part_harga_jual;
                    $model->spare_part_stock = $request->spare_part_stock;
                    $model->spare_part_sold = $request->spare_part_sold;
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
        $primaryKey = 'spare_part_id';
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
                        'spare_parts.*',
                        'dev_units.dev_unit_name',
                        'parents.parent_id',
                        'parents.parent_name',
                        'unit_parts.unit_part_name'
                        )
                        ->join('dev_units','spare_parts.dev_unit_id','dev_units.dev_unit_id')
                        ->join('parents','dev_units.parent_id','parents.parent_id')
                        ->join('unit_parts','spare_parts.unit_part_id','unit_parts.unit_part_id')
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
        $primaryKey = 'spare_part_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer',
            'dev_unit_id' => 'required|integer',
            'unit_part_id' => 'required|integer',
            'spare_part_name' => 'required|string',
            'spare_part_harga_awal' => 'required|string',
            'spare_part_harga_jual' => 'required|string',
            'spare_part_stock' => 'required|string',
            'spare_part_sold' => 'required|string'
        );
        $primaryKey_value = $request->spare_part_id;
        
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
                        'unit_part_id' => $request->unit_part_id,
                        'spare_part_name' => $request->spare_part_name,
                        'spare_part_harga_awal' => $request->spare_part_harga_awal,
                        'spare_part_harga_jual' => $request->spare_part_harga_jual,
                        'spare_part_stock' => $request->spare_part_stock,
                        'spare_part_sold' => $request->spare_part_sold,
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
        $primaryKey = 'spare_part_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer'
        );
        $primaryKey_value = $request->spare_part_id;

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