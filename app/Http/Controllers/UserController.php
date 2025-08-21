<?php

namespace App\Http\Controllers;

use App\Models\User;
// use App\Models\Users;
use App\Traits\ApiTrait;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiTrait;

    public function register(Request $request)
    {
        try {
            $data = User::create([
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
        try {

            $user = User::where('email', $request->input('email'))->first();
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return $this->error('invalid password');
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->success('login successfully', $token, $user);
        } catch (\Throwable $th) {
            // return $th;
            return $this->error('invalid ');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
