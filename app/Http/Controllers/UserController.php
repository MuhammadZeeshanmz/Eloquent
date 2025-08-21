<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UserService;
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

    protected $userService;


    public function __construct(UserService $userService)
    {
        return $this->userService = $userService;
    }

    public function register(Request $request)
    {
        try {
            $data = $this->userService->createUser($request);
            // $data = User::create([
            //     'name' => $request->input('name'),
            //     'email' => $request->input('email'),
            //     'password' => Hash::make($request->input('password')),

            // ]);

            // return $this->success('Register successfully', $data, );

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
            $user->token = $token;
            return $this->success('login successfully',  $user,  201);
        } catch (\Throwable $th) {
            // return $th;
            return $this->error('invalid ');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();


        // return $this->success('Logged out successfully');

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
