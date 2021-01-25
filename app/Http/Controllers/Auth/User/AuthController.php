<?php

namespace App\Http\Controllers\Auth\User;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['Datos Requeridos'],202);

        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return $this->responseWithToken($token,$request->email);
    }

    protected function responseWithToken($token,$email)
    {   
        $id = User::select('id')->where('email',$email)->first();
        return response()->json([
            'status' => 'ok',
            'token' => $token,
            'token_type' => 'bearer',
            'id' => $id->id,
            'email' => $email
        ]);
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['mensaje' => 'Datos Requeridos'],202);
        
        if(User::where('email',$request->email)->first()){
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario registrado'
            ],401);
        }else{
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = 0;
            $user->save();
        }

        return response()->json(['status' => 'ok'],200);
    }

    public function logout(Request $request)
    {
        auth($this->guard)->logout();
        return response()->json(['mensaje' => 'Ha cerrado sesión satisfactoriamente']);
    }
}