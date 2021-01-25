<?php

namespace App\Http\Controllers\Admin;

use App\Models\Egresado;
use App\Models\ListaCarrera;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Filter;
use App\Http\Controllers\Controller;

class EgresadosController extends Controller
{
    public function allEgresados(Request $request)
    {
        $carrera           = $request->carrera;
        $opcion            = $request->opcion;
        $opcionElegida     = $request->inputOption;
        $anioIngresado     = $request->yearIngreso;
        $anioEgresado      = $request->yearEgreso;
        $dateRangeIngreso  = $request->fechaIngresoRange;
        $dateRangeEgreso   = $request->fechaEgresoRange;
        $dateSpeIngreso    = $request->fechaIngresoSpe;
        $dateSpeEgreso     = $request->fechaEgresoSpe;

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
        $egresados      = $filterTramites->getEgresados($opcionElegida,$opcion,$carrera,$dates);
        
        $carreras  = ListaCarrera::all();

        if(!$carrera) $carrera = " ";
        if(!$anioIngresado) $anioIngresado = " ";
        if(!$anioEgresado) $anioEgresado = " ";
        if(!$dateRangeIngreso) $dateRangeIngreso = " ";
        if(!$dateRangeEgreso) $dateRangeEgreso = " ";
        if(!$dateSpeIngreso) $dateSpeIngreso = " ";
        if(!$dateSpeEgreso) $dateSpeEgreso = " ";

        return view('egresados.index',[
            'yearIngresoSelected' => $anioIngresado,
            'yearEgresoSelected'  => $anioEgresado,
            'dateRangeIngreso'    => $dateRangeIngreso,
            'dateRangeEgreso'     => $dateRangeEgreso,
            'dateSpeIngreso'      => $dateSpeIngreso,
            'dateSpeEgreso'       => $dateSpeEgreso,
            'yearsIngreso'        => $yearsIngreso,
            'yearsEgreso'         => $yearsEgreso,
            'egresados'           => $egresados,
            'carreras'            => $carreras,
            'career'             => $carrera,
        ]);
    }

    public function deleteEgresado($id)
    {
        $egresado = Egresado::where('id',$id);
        $egresado->delete();
        return redirect()->route('egresados.filtrar');
    }
}