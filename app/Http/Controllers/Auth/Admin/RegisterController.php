<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use App\Mail\EmailInvitationAdminRegister;

class RegisterController extends Controller
{
    public function getEmailRegister()
    {
        return view ('auth.send_mail_invitation');
    }

    public function sendEmailRegister(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
            return back()->withErrors(['email' => 'Existe un usuario registrado con el email: '.$request->email]);
        
        DB::table('register_tokens')->insert([
            'email' => $request->email,
            'token' => Str::random(40),
            'created_at' => Carbon::now()
        ]);

        $userToken = DB::table('register_tokens')
        ->where('email',$request->email)->latest()->first();

        if($this->sendingRegisterEmail($request->email,$userToken->token))
            return redirect()->back()->with('status','Un email ha sido enviado al correo '.$request->email);
        else
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error de conexión. Por favor, intente nuevamente']);
        
        return back()->with(['success' => 'Verifique su bandeja de entrada del email'.$request->email]);
    }

    private function sendingRegisterEmail($email,$token)
    {
        $link = \URL::to('/') . '/register/' . $token . '?email=' . urlencode($email);
        
        try{
            \Mail::to($email)->send(new EmailInvitationAdminRegister($link));
            return true;
        }
        catch(\Throwable $th){
            return false;
        }
    }

    public function showRegisterForm($token)
    {
        return view('auth.register',['token' => $token]);
    }

    public function postRegister(Request $request)
    {   
        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        
        $tokenData = DB::table('register_tokens')
        ->where('email',$request->email)->where('token',$request->token)->first();

        if (!$tokenData) 
            return redirect()->back()->withErrors(['email' => 'Correo Electrónico inválido']);
        else{
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = 1;
            $user->save();

            $this->deleteRegisterTokens($request->email);
            if(Auth::guest()){
                return redirect()->route('dashboard');
            }
            return redirect()->back()->with('status','el email: '. $request->email. ' ha sido registrado con éxito');
        }
    }
    private function deleteRegisterTokens($email)
    {
        $users = DB::table('register_tokens')->where('email',$email)->delete();
    }
}