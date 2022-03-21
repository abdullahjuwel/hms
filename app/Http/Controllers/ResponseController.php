<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function respondWithError($message, $error, $statuscode){
        $status = "failed";
        return response()->json([
            'status'      => $status,
            'message'     => $message,
            'errors'       => $error,
            'status_code' => $statuscode
        ]); 
    }
    public function respondWithSuccess($message, $data, $statuscode){
        $status = "success";
        return response()->json([
            'status'      => $status,
            'message'     => $message,
            'data'        => $data,
            'status_code' => $statuscode
        ]); 
    }
}
