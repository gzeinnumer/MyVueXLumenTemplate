<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;

//RESPONSE MODEL
use Illuminate\Database\Eloquent\Model;
class MasterMSG extends Model
{    
    const INSERT_SUKSES_MSG = 'Berhasil Menyimpan Data Ke ';
    const INSERT_GAGAL_MSG = 'Gagal Menyimpan Data Ke ';

    const READ_SUKSES_MSG = 'Berhasil Mendapatkan Data ';
    const READ_GAGAL_MSG = 'Gagal Mendapatkan Data ';

    const UPDATE_SUKSES_MSG = 'Berhasil Mengupdate Data ';
    const UPDATE_GAGAL_MSG = 'Gagal Mengupdate Data ';

    const DELETE_SUKSES_MSG = 'Berhasil Menghapus Data ';
    const DELETE_GAGAL_MSG = 'Gagal Menghapus Data ';

    const CATCH_GAGAL_MSG = 'Terjadi Kesalahan Pada Proses ';
    const DATA_NOT_FOUND = 'Data Tidak Ditemukan Di Table ';
    const USER_LOGIN_NOT_FOUND = 'User Tidak Memiliki Akses ';
}

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

    //INSERT
    protected function onSuccessInsert($model,$request){
        $code = 200;
        $msg = array(
            'warning' => 'clear',
            'message' => MasterMSG::INSERT_SUKSES_MSG.$model::tableName,
            'status' => $model::INSERT_SUKSES_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }

    protected function onFailedInsert($model,$request){
        $code = 500;
        $msg = array(
            'warning' => 'clear',
            'message' => MasterMSG::INSERT_GAGAL_MSG.$model::tableName,
            'status' => $model::INSERT_GAGAL_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }
    //END INSERT

    //READ
    protected function onSuccessRead($model, $coll,$request){     
        $code = 200;
        $msg = array(
            'warning' => 'clear',
            'message' => MasterMSG::READ_SUKSES_MSG.$model::tableName,
            'status' => $model::READ_SUKSES_CODE,
            'data' => $coll
        );
         
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }

    protected function onFailedRead($model,$request){
        $code = 500;
        $msg = array(
            'warning' => MasterMSG::DATA_NOT_FOUND.$model::tableName,
            'message' => MasterMSG::READ_GAGAL_MSG,
            'status' => $model::READ_GAGAL_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }
    //END READ
    
    //UPDATE
    protected function onSuccessUpdate($model,$request){
        $code = 200;
        $msg = array(
            'warning' => 'clear',
            'message' => MasterMSG::UPDATE_SUKSES_MSG.$model::tableName,
            'status' => $model::UPDATE_SUKSES_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }

    protected function onFailedUpdate($model,$request){
        $code = 500;
        $msg = array(
            'warning' => MasterMSG::DATA_NOT_FOUND.$model::tableName,
            'message' => MasterMSG::UPDATE_GAGAL_MSG,
            'status' => $model::UPDATE_GAGAL_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }
    //END UPDATE
    
    //DELETE
    protected function onSuccessDelete($model,$request){
        $code = 200;
        $msg = array(
            'warning' => 'clear',
            'message' => MasterMSG::DELETE_SUKSES_MSG.$model::tableName,
            'status' => $model::DELETE_SUKSES_CODE,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }

    protected function onFailedDelete($model, $request){
        return response()->json([
            'warning' => MasterMSG::DATA_NOT_FOUND.$model::tableName,
            'message' => MasterMSG::DELETE_GAGAL_MSG,
            'status' => $model::DELETE_GAGAL_CODE,
            'data' => array()
        ], 500);
    }
    //END DELETE
    
    //TRY CATCH
    protected function onFailedCatch($model, $msg, $request){
        $code = 500;

        $msg = array(
            'warning' => $msg,
            'message' => MasterMSG::CATCH_GAGAL_MSG.$model::tableName,
            'status' => 0,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }
    //END TRY CATCH

    //FIND USER
    protected function onFailedFindUserLogin($model, $request){
        $code = 500;

        $msg = array(
            'warning' => 'User Login dengan id '.$request->user_login.' tidak ditemukan',
            'message' => MasterMSG::USER_LOGIN_NOT_FOUND,
            'status' => 0,
            'data' => array()
        );
                
        $saveLog = $this->writeLog(
            $model,
            $request,
            $msg,
            $code
        );

        return response()->json($msg, $code);
    }
    //END FIND USER

    // START LOG API 
    protected function writeLog(
        $model,
        $request,
        $msg,
        $code
    ){
        // $userId = 0;
        $userId = $request->user_login;

        DB::table('log_apis')->insert(
            [
                'url' => $request->url(), 
                'api_name' => $model::tableName, 
                'end_point' => $request->url(), 
                'method' => $request->method(), 
                'user_id' => $userId, 
                'request' => json_encode($request->all()), 
                'response' => json_encode($msg), 
                'api_response_id' => 0, 
                'response_code' => 0, 
                'message' => $msg['message'], 
                'request_time' => 0, 
                'response_time' => 0, 
                'http_coderesponse' => $code, 
                'http_msgresponse' => 0, 
                'keterangan' => $msg['warning'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
	}
	// END LOG API
}


