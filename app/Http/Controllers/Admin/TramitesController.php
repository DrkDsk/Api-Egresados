<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tramite;
use App\Models\ListaCarrera;
use App\Models\ListaTramite;
use App\Http\Controllers\Admin\Filter;

class TramitesController extends Controller
{
    public function allTramites(Request $request)
    {   
        $tramite  = $request->tramite;
        $carrera  = $request->carrera;
        $anioIngresado = $request->yearIngreso;
        $anioEgresado  = $request->yearEgreso;
        $dateRangeIngreso = $request->fechaIngresoRange;
        $dateRangeEgreso  = $request->fechaEgresoRange;
        $dateSpeIngreso = $request->fechaIngresoSpe;
        $dateSpeEgreso = $request->fechaEgresoSpe;

        $dates = [
            $dateRangeIngreso,
            $dateRangeEgreso,
            $dateSpeIngreso,
            $dateSpeEgreso,
            $anioIngresado,
            $anioEgresado
        ];

        $filterTramites = new Filter();
        $yearsIngreso   = $filterTramites->getYearsIngreso();
        $yearsEgreso    = $filterTramites->getYearsEgreso();
        $tramites      = $filterTramites->getTramites($tramite,$carrera,$dates);

        $carreras = ListaCarrera::all();
        $listaTramites = ListaTramite::all();

        if(!$tramite) $tramite = " ";
        if(!$carrera) $carrera = " ";
        if(!$anioIngresado) $anioIngresado = " ";
        if(!$anioEgresado) $anioEgresado = " ";
        if(!$dateRangeIngreso) $dateRangeIngreso = " ";
        if(!$dateRangeEgreso) $dateRangeEgreso = " ";
        if(!$dateSpeIngreso)  $dateSpeIngreso = " ";
        if(!$dateSpeEgreso) $dateSpeEgreso = " ";

        return view('tramites.all',[ 
            'tramites' => $tramites,
            'carreras' => $carreras,
            'listaTramites' => $listaTramites,
            'yearsIngreso' => $yearsIngreso,
            'yearsEgreso'  => $yearsEgreso,
            'yearIngresoSelected' => $anioIngresado,
            'yearEgresoSelected' => $anioEgresado,
            'dateRangeIngreso'    => $dateRangeIngreso,
            'dateRangeEgreso'     => $dateRangeEgreso,
            'dateSpeIngreso'      => $dateSpeIngreso,
            'dateSpeEgreso'       => $dateSpeEgreso,
            'carreraSelected' => $carrera,
            'tramiteSelected' => $tramite
        ]);
    }

    public function getTramites($id)
    {
        $tramites = Tramite::where('egresado_id',$id)->get();
        return view('tramites.index',['tramites' => $tramites]);
    }

    public function finishTramite($id)
    {
        $tramite = Tramite::where('id',$id)->first();
        if($tramite){
            $tramite->finalizado = !$tramite->finalizado;;
            $tramite->save();
        }
        return redirect()->route('egresados.filtrar');
    }

    public function deleteTramite($id)
    {
        $tramite = Tramite::where('id',$id);
        $tramite->delete();
        return redirect()->back();
    }
}