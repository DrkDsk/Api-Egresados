<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use URL;
use App\Mail\EmailForgotAdminPassword;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view ('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email',$request->email)->where('is_admin',1)->first();

        if(!$user){
            return back()->withErrors(['email' => 'No se encontró ningún email '.$request->email]);
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(40),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')
        ->where('email',$request->email)->latest()->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status','Un email ha sido enviado al correo '.$request->email);
        } else {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error de conexión. Por favor, intente nuevamente']);
        }

        return back()->with(['success' => 'Verifique su bandeja de entrada del email'.$request->email]);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password',[
            'token' => $token
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password'=>    'required|confirmed|min:10|regex:/[a-z]/
                            |regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'token' => 'required'
        ]);
        
        $password = $request->password;
        $tokenData = DB::table('password_resets')->where('token',$request->token)->where('email',$request->email)->first();
        
        if (!$tokenData) return redirect()->back()->withErrors(
            ['email' => 'Correo Electrónico inválido']
        );
        
        $user = User::where('email', $tokenData->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('email',$tokenData->email)->delete();
        return redirect()->route('login');
    }

    private function sendResetEmail($email,$token)
    {
        $user = DB::table('users')->where('email',$email)->select('email')->first();
        $link = \URL::to('/') . '/password/reset/' . $token;

        try {
            \Mail::to($user)->queue(new EmailForgotAdminPassword($link));
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }
}