<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    //登入
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['status' => 0, 'message' => '無效的驗證資料'], 401);
        }
        return response()->json(['status' => 1, 'token' => $token]);
    }
    //取得登入者的資料
    public function me()
    {
        return response()->json(auth()->user());
    }

    //登出
    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => 1]);
    }
}
