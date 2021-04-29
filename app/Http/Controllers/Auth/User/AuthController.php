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
            return response()->json([$validator->errors()->first()],202);

        try {
            if (!$token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0])) {
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json([$validator->errors()->first()],400);
        
        if(User::where('email',$request->email)->first()){
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario registrado'
            ],401);
        }else{
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 0
            ]);

            $token = JWTAuth::attempt([
                'email' => $request->email, 
                'password' => $request->password, 
                'is_admin' => 0
            ]);

            return $this->responseWithToken($token,$request->email);
        }
    }

    public function logout( Request $request ) {

        $token = $request->header( 'Authorization' );

        try {
            JWTAuth::parseToken()->invalidate( $token );

            return response()->json( [
                'error'   => false,
                'message' => trans( 'auth.logged_out' )
            ] );
        } catch ( TokenExpiredException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.expired' )

            ], 401 );
        } catch ( TokenInvalidException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.invalid' )
            ], 401 );

        } catch ( JWTException $exception ) {
            return response()->json( [
                'error'   => true,
                'message' => trans( 'auth.token.missing' )
            ], 500 );
        }
    }

    public function getUser($id)
    {
        $usuarioActivo = User::where('id',$id)->first();
        if($usuarioActivo)
            return response()->json(['ok' => 'active'],200);
        return response()->json(['wrong' => 'inactive'],403);
    }
}