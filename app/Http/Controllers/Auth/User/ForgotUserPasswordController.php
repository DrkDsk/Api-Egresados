<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use App\Mail\EmailForgotUserPassword;
use Illuminate\Support\Facades\Hash;

class ForgotUserPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email',$request->email)->where('is_admin',0)->first();

        if(!$user){
            return response()->json(["No se encontró el email"],401);
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(40),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')
        ->where('email',$request->email)->latest()->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return response()->json(["token" => "Token Enviado"]);
        } else {
            return response()->json(["Ha ocurrido un error inesperado, intente nuevamente más tarde"],402);
        }
    }

    public function updatePassword(Request $request)
    {
        $tokenData = DB::table('password_resets')->where('token',$request->token)->where('email',$request->email)->first();
        
        if (!$tokenData)
            return response()->json(["Correo electrónico inválido"],401);
        
        $user = User::where('email', $tokenData->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('email',$tokenData->email)->delete();
        return response()->json(["Contraseña actualizada"]);
    }

    private function sendResetEmail($email,$token)
    {
        $user = DB::table('users')->where('email',$email)->select('email')->first();

        try {
            \Mail::to($user)->send(new EmailForgotUserPassword($token));
            return true;
        }
        catch (\Exception $e) {
            return false;
        }
    }
}