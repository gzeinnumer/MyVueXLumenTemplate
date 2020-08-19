<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterCode extends Model
{
    protected $table = 'parents';
    const tableName = 'Parents';

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
            'parent_id' => $this->parent_id,
            'parent_name' => $this->parent_name,
            'parent_address' => $this->parent_address,
            'parent_photo' => $this->parent_photo,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
        ];
    }
}

//CONTROLLER
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User as Login;
use App\Parents as CurrentModel;

class ParentsController extends Controller
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
                    $data =CurrentModel::where('is_delete','0')->get();
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
            'parent_name' => 'required|string',
            'parent_address' => 'required|string',
            'parent_photo' => 'required|string'
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
                    $model->parent_name = $request->parent_name;
                    $model->parent_address = $request->parent_address;
                    $model->parent_photo = $request->parent_photo;
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
        $primaryKey = 'parent_id';
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
                    $data = CurrentModel::where($primaryKey,$id)->get();
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
        $primaryKey = 'parent_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer',
            'parent_name' => 'required|string',
            'parent_address' => 'required|string',
            'parent_photo' => 'required|string'
        );
        $primaryKey_value = $request->parent_id;
        
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
                        'parent_name' => $request->parent_name,
                        'parent_address' => $request->parent_address,
                        'parent_photo' => $request->parent_photo,
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
        $primaryKey = 'parent_id';
        $input = array(
            'user_login' => 'required|integer',
            $primaryKey => 'required|integer'
        );
        $primaryKey_value = $request->parent_id;

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