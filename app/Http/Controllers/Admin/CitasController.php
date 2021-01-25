<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailsNotSends;
use App\Http\Controllers\Admin\Filter;
use App\Mail\EmailEgresados;
use App\Models\Cita;
use App\Models\User;
use App\Models\Egresado;
use App\Models\Tramite;
use App\Models\ListaCarrera;
use App\Models\ListaTramite;

class CitasController extends Controller
{
    public function getCitasNoEnviadas()
    {
        $citasNoEnviadas = EmailsNoTSends::all();
        return view('citas.citasNoEnviadas',['citas' => $citasNoEnviadas]);
    }

    public function sendMailsRestantes(Request $request)
    {   
        
        $selected = $request->only('option');
        $filterEmails = new Filter();

        if($selected)
            $citasSelected = $filterEmails->getEmailsNoEnviados($selected);
        else
            $citasSelected = EmailsNotSends::all();   
        
        foreach($citasSelected as $cita){
            $tramite = Tramite::where('id',$cita->tramite_id)->first()->tipo;

            $data = [
                "mensaje" => $cita->mensaje,
                "asunto"  => $cita->asunto,
                "fecha"   => $cita->fecha,
                "hora"    => $cita->hora,
                "tramite" => $tramite
            ];

            try {
                \Mail::to($cita->destino)->send(new EmailEgresados($data));
                
                $newCita = new Cita();
                $newCita->tramite_id = $cita->tramite_id;
                $newCita->descripcion = $cita->mensaje;
                $newCita->fecha = $cita->fecha;
                $newCita->hora = $cita->hora;
                $newCita->asunto = $cita->asunto;
                $newCita->save();

                $cita = EmailsNotSends::where('id',$cita->id);
                $cita->delete();

            } catch (\Throwable $th) {   
            }
        }
        return redirect()->back()->with('status','Se han enviado los emails seleccionados');
    }

    public function getMails($tramite,$carrera,$yearIngreso,$yearEgreso,$dateRangeIngreso,$dateRangeEgreso,$dateSpeIngreso,$dateSpeEgreso)
    {
        $dates = [
            $dateRangeIngreso,
            $dateRangeEgreso,
            $dateSpeIngreso,
            $dateSpeEgreso,
            $yearIngreso,
            $yearEgreso
        ];
        
        $filterEmails = new Filter();
        $egresados = $filterEmails->getTramites($tramite,$carrera,$dates);

        if(!$tramite) $tramite = " ";
        if(!$carrera) $carrera = " ";
        if(!$yearIngreso) $yearIngreso = " ";
        if(!$yearEgreso) $yearEgreso = " ";
        if(!$dateRangeIngreso) $dateRangeIngreso = " ";
        if(!$dateRangeEgreso) $dateRangeEgreso = " ";
        if(!$dateSpeIngreso)  $dateSpeIngreso = " ";
        if(!$dateSpeEgreso) $dateSpeEgreso = " ";

        return view('citas.mails',[
            'yearIngresoSelected' => $yearIngreso,
            'yearEgresoSelected'  => $yearEgreso,
            'dateRangeIngreso' => $dateRangeIngreso,
            'dateRangeEgreso'  => $dateRangeEgreso,
            'dateSpeIngreso' => $dateSpeIngreso,
            'dateSpeEgreso' => $dateSpeEgreso,
            'egresados' => $egresados,
            'carreraS'  => $carrera,
            'tramiteS'  => $tramite,
        ]);
    }

    public function sendEmails(Request $request,$tramite,$carrera,$yearIngreso,$yearEgreso,$dateRangeIngreso,$dateRangeEgreso,$dateSpeIngreso,$dateSpeEgreso)
    {   
        $request->validate([
            'mensaje' => 'required',
            'fecha'   => 'required',
            'hora'    => 'required',
            'asunto'  => 'required'
        ]);
        
        $selected = $request->only('option');
        $fails = false;
        
        $dates = [
            $dateRangeIngreso,
            $dateRangeEgreso,
            $dateSpeIngreso,
            $dateSpeEgreso,
            $yearIngreso,
            $yearEgreso
        ];

        $filterEmails = new Filter();

        if($selected)
            $egresadosSelected = $filterEmails->getMailsCheckbox($tramite,$carrera,$dates,$selected);
        else
            $egresadosSelected = $filterEmails->getMailsRestantes($tramite,$carrera,$dates,$selected);
        
        $data = [
            "mensaje" => $request->mensaje,
            "asunto"  => $request->asunto,
            "fecha"   => $request->fecha,
            "hora"    => $request->hora,
        ];

        if ($request->hasFile('file'))
            $data["file"] = $request->file('file');
        
        foreach ($egresadosSelected as $tramite){
            $user = Egresado::where('id',$tramite->egresado_id)->first()->user_id;
            $user = User::where('id',$user)->first()->email;
            $data["tramite"] = $tramite->tipo;

            try {
                \Mail::to($user)->send(new EmailEgresados($data));

                $cita = new Cita();
                $cita->tramite_id = $tramite->id;
                $cita->descripcion = $request->mensaje;
                $cita->fecha = $request->fecha;
                $cita->hora  = $request->hora;
                $cita->asunto = $request->asunto;
                $cita->save();
            } catch (\Throwable $th) {
                \DB::table('emails_not_sends')->insert([
                    'destino' => $user,
                    'mensaje' => $request->mensaje,
                    'tramite_id' => $tramite->id,
                    'fecha' => $request->fecha,
                    'hora'  => $request->hora,
                    'asunto' => $request->asunto
                ]);
                $fails = true;
            }
        }
        return redirect()->back()->with('status','Se han envíado Correctamente los Correos');
    }

    public function allCitas(Request $request)
    {
        $tramite = $request->tramite;
        $carrera = $request->carrera;
        
        $citas = new Filter();
        $citas = $citas->getAllCitas($tramite,$carrera);

        $carreras = ListaCarrera::all();
        $tramites = ListaTramite::all();

        if(!$tramite) $tramite = ' ';
        if(!$carrera) $carrera = ' ';

        return view ('citas.all',[ 
            'citas'    => $citas,
            'carreras' => $carreras,
            'tramites' => $tramites,
            'carreraS' => $carrera,
            'tramiteS' => $tramite,
        ]);
    }

    public function getCitas($id)
    {
        $citas = Cita::with('tramites')->where('tramite_id',$id)->get();
        return view('citas.index',['id' => $id,'citas' => $citas]);
    }

    public function postCitar(Request $request,$id)
    {
        $request->validate([
            'mensaje' => 'required',
            'fecha'   => 'required',
            'hora'    => 'required',
            'asunto'  => 'required'
        ]);

        $user = Tramite::where('id',$id)->first()->egresado_id;
        $user = Egresado::where('id',$user)->first()->user_id;
        $user = User::where('id',$user)->first()->email;
        $tramite = Tramite::where('id',$id)->first()->tipo;
        
        $data = [
            "tramite" => $tramite,
            "mensaje" => $request->mensaje,
            "asunto"  => $request->asunto,
            "fecha"   => $request->fecha,
            "hora"    => $request->hora,
        ];

        if ($request->hasFile('file'))
            $data["file"] = $request->file('file');

        try {
            \Mail::to($user)->send(new EmailEgresados($data));

            $cita = new Cita();
            $cita->tramite_id = $id;
            $cita->descripcion = $request->mensaje;
            $cita->fecha = $request->fecha;
            $cita->hora  = $request->hora;
            $cita->asunto = $request->asunto;
            $cita->save();

        } catch (\Throwable $th) {
            \DB::table('emails_not_sends')->insert([
                'destino' => $user,
                'mensaje' => $request->mensaje,
                'tramite_id' => $id,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'asunto' => $request->asunto
            ]);
        }
        return redirect()->back()->with('status','Un email ha sido enviado al correo');
    }

    public function deleteCita($id)
    {
        $cita = Cita::where('id',$id);
        $cita->delete();
        return redirect()->back();
    }
}
