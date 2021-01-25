<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cita;
use App\Models\User;
use App\Models\Tramite;
use App\Models\Egresado;
use App\Exports\CitasExport;
use Illuminate\Http\Request;
use App\Exports\TramitesExport;
use App\Exports\EgresadosExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DownloadsFilesController extends Controller
{
    public function downloadEgresados($carrera,$yearIngreso,$yearEgreso,$dateRangeIngreso,$dateRangeEgreso,$dateSpeIngreso,$dateSpeEgreso)
    {
        if($carrera == " ") $carrera = "";
        if($yearIngreso == " ") $yearIngreso = "";
        if($yearEgreso  == " ") $yearEgreso = "";
        if($dateRangeIngreso == " ") $dateRangeIngreso = "";
        if($dateRangeEgreso == " ") $dateRangeEgreso = "";
        if($dateSpeIngreso == " ") $dateSpeIngreso = "";
        if($dateSpeEgreso == " ") $dateSpeEgreso = "";

        $egresados = Egresado::join('users','users.id','=','egresados.user_id')
        ->select('egresados.name','egresados.apellido1','egresados.apellido2',
        'egresados.noControl','egresados.movil','egresados.telefono_casa',
        'users.email','egresados.email_alternativo','egresados.carrera',
        'egresados.fechaIngreso','egresados.fechaEgreso')
        ->get();

        $usersExport = new EgresadosExport($egresados);
        return $usersExport->download('egresados.xlsx');
    }

    public function downloadTramites($tramite,$carrera,$yearIngreso,$yearEgreso,$dateRangeIngreso,$dateRangeEgreso,$dateSpeIngreso,$dateSpeEgreso)
    {
        if($carrera == " ") $carrera = "";
        if($tramite == " ") $tramite = "";
        if($yearIngreso == " ") $yearIngreso = "";
        if($yearEgreso  == " ") $yearEgreso = "";
        if($dateRangeIngreso == " ") $dateRangeIngreso = "";
        if($dateRangeEgreso == " ") $dateRangeEgreso = "";
        if($dateSpeIngreso == " ") $dateSpeIngreso = "";
        if($dateSpeEgreso == " ") $dateSpeEgreso = "";

        $tramites = Tramite::join('egresados','egresado_id','=','egresados.id')
        ->join('users','users.id','=','egresados.user_id')
        ->select('egresados.name','egresados.apellido1',
        'egresados.apellido2','egresados.noControl','egresados.movil','egresados.telefono_casa',
        'users.email','egresados.email_alternativo','egresados.carrera','egresados.fechaIngreso',
        'egresados.fechaEgreso','tramites.tipo' )
        ->tipo($tramite)
        ->carrera($carrera)
        ->fechaIngresoRange($dateRangeIngreso)
        ->fechaEgresoRange($dateRangeEgreso)
        ->fechaIngresoSpe($dateSpeIngreso)
        ->fechaEgresoSpe($dateSpeEgreso)
        ->yearIngreso($yearIngreso)
        ->yearEgreso($yearEgreso)
        ->get();

        $tramitesExport = new TramitesExport($tramites);
        return $tramitesExport->download('tramites.xlsx');
    }

    public function downloadCitas($tramite,$carrera)
    {        
        if($tramite == " ") $tramite = "";
        if($carrera == " ") $carrera = "";

        $citas = Cita::join('tramites','citas.tramite_id','=','tramites.id')
        ->join('egresados','tramites.egresado_id','=','egresados.id')
        ->join('users','users.id','=','egresados.user_id')
        ->select('egresados.name','egresados.apellido1',
        'egresados.apellido2','egresados.noControl','egresados.movil','egresados.telefono_casa',
        'users.email','egresados.email_alternativo','egresados.carrera','egresados.fechaIngreso',
        'egresados.fechaEgreso','tramites.tipo','citas.descripcion','citas.asunto',
        'citas.fecha','citas.hora',)
        ->tipo($tramite)
        ->carrera($carrera)
        ->get();

        $citasExport = new CitasExport($citas);
        return $citasExport->download('citas.xlsx');
    }
}
