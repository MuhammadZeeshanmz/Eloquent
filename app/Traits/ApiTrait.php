<?php

namespace App\Traits;
use App\Models\Users;

trait ApiTrait
{
    public function success( string $msg,  $data = [], $code = 200){
        return response()->json([
            'message'=> $msg,
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
