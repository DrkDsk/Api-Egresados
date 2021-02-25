<?php
namespace App\Http\Controllers\Admin;

use App\Models\Tramite;
use App\Models\Egresado;
use App\Models\EmailsNotSends;
use App\Models\Cita;
use App\Models\User;
use Carbon\Carbon;

class Filter{

    public function getEgresados($opcionElegida,$opcion,$carrera,$dates)
    {
        if($carrera == ' ') $carrera = "";

        $egresados = Egresado::tipo($opcionElegida,$opcion)
            ->carrera($carrera)
            ->fechaIngresoRange($dates[0])
            ->fechaEgresoRange($dates[1])
            ->fechaIngresoSpe($dates[2])
            ->fechaEgresoSpe($dates[3])
            ->yearIngreso($dates[4])
            ->yearEgreso($dates[5])
            ->paginate(10);

        return $egresados;
    }

    public function getTramites($tramite,$carrera,$dates)
    {
        if($carrera == ' ') $carrera = "";
        if($tramite == ' ') $tramite = "";

        for($i = 0; $i<count($dates); ++$i)
            if($dates[$i] == " ") $dates[$i] = "";

        return Tramite::tipo($tramite)
            ->carrera($carrera)
            ->fechaIngresoRange($dates[0])
            ->fechaEgresoRange($dates[1])
            ->fechaIngresoSpe($dates[2])
            ->fechaEgresoSpe($dates[3])
            ->yearIngreso($dates[4])
            ->yearEgreso($dates[5])
            ->paginate(10);
    }

    public function getMailsCheckBox($tramite,$carrera,$dates,$selected)
    {
        if($carrera == ' ') $carrera = "";
        if($tramite == ' ') $tramite = "";

        for($i = 0; $i<count($dates); ++$i)
            if($dates[$i] == " ") $dates[$i] = "";

        return Tramite::tipo($tramite)
            ->carrera($carrera)
            ->fechaIngresoRange($dates[0])
            ->fechaEgresoRange($dates[1])
            ->fechaIngresoSpe($dates[2])
            ->fechaEgresoSpe($dates[3])
            ->yearIngreso($dates[4])
            ->yearEgreso($dates[5])
            ->where(function ($consulta) use ($selected){
                foreach($selected as $id) {
                    if($selected)
                        $consulta->whereIn('tramites.id',$id);
                    else
                        $consulta->whereNotIn('tramites.id',$id);
                }
            })->paginate(10);
    }

    public function getAllCitas($tramite,$carrera)
    {
        return Cita::
            tipo($tramite)
            ->carrera($carrera)
            ->paginate(10);
    }

    public function getYearsIngreso()
    {
        $yearsIngreso = Egresado::select('fechaIngreso')->get();
        $arrayYearsIngreso = [];

        foreach($yearsIngreso as $year){
            $yearIngreso = Carbon::createFromFormat('Y-m-d',$year->fechaIngreso)->year;
            if(!in_array($yearIngreso,$arrayYearsIngreso))
                array_push($arrayYearsIngreso,$yearIngreso);
        }
        rsort($arrayYearsIngreso);
        return $arrayYearsIngreso;
    }

    public function getYearsEgreso()
    {

        $yearsEgreso = Egresado::select('fechaEgreso')->get();
        $arrayYearsEgresado = [];

        foreach($yearsEgreso as $year){
            $yearEgreso = Carbon::createFromFormat('Y-m-d',$year->fechaEgreso)->year;
            if(!in_array($yearEgreso,$arrayYearsEgresado))
                array_push($arrayYearsEgresado,$yearEgreso);
        }
        rsort($arrayYearsEgresado);
        return $arrayYearsEgresado;
    }

    public function getEmailsNoEnviados($selected)
    {
        $citas = EmailsNotSends::where(function ($consulta) use ($selected){
            foreach($selected as $id){
                $consulta->whereIn('emails_not_sends.id',$id);
            }
        })->get();

        return $citas;
    }
}
