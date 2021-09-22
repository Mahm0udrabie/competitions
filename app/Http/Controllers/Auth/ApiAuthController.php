<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class ApiAuthController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function register (RegisterRequest $request) {
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = $this->model->create($request->all());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $user = new UserResource($user);
        $user['token'] = $token;


        return response()->json(
            [
                "status" => "success",
                "data"   =>  $user,
            ],
            200
        );
    }
    public function login (LoginRequest $request) {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $user = new UserResource($user);
                $user['token'] = $token;
                return response()->json(
                    [
                        "status" => "success",
                        "data"   =>  $user,
                    ],
                    200
                );
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);

        }
    }
    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
