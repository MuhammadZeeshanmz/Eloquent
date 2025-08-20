<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $data = Users::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),

            ]);

            return response()->json([
                'user' => $data,
            ], 201);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function login(Request $request)
    {


        $user = Users::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;
        }

        return response()->json([
            'message' => 'login sucessfully',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
