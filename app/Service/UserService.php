<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function createUser($request){

        $data = User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> Hash::make($request->input('password')),
            'role_permission_id'=>$request->input('role_permission_id'),
        ]);
        return $data;

    }
    
}
