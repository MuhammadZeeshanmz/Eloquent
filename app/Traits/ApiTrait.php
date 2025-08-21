<?php

namespace App\Traits;
use App\Models\Users;

trait ApiTrait
{
    public function success( string $msg, $token = null, $data = [], $code = 200){
        return response()->json([
            'message'=> $msg,
            'token'=> $token,
            'data'=> $data,
         
        ], $code
    );
    }
    public function error(string $msg, $code = 500) {
        return response()->json([
              'message'=> $msg,
        ],  $code);
    }
}
