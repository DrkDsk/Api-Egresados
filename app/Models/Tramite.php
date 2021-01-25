<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = ['tipo','finalizado'];

    public function ScopeTipo($query,$tipo)
    {
        if($tipo) return $query->where('tipo',$tipo);
    }

    public function ScopeCarrera($query,$carrera)
    {
        if($carrera) return $query->where('egresados.carrera',$carrera);
    }

    public function ScopeFechaIngresoRange($query,$fechaIngresoRange)
    {
        if($fechaIngresoRange) return $query->whereDate('egresados.fechaIngreso','>=',$fechaIngresoRange);
    }

    public function ScopeFechaEgresoRange($query,$fechaEgresoRange)
    {
        if($fechaEgresoRange) return $query->whereDate('egresados.fechaEgreso','<=',$fechaEgresoRange);
    }
    
    public function ScopeFechaIngresoSpe($query,$fechaIngresoSpe)
    {
        if($fechaIngresoSpe) return $query->whereDate('egresados.fechaIngreso',$fechaIngresoSpe);
    }

    public function ScopeFechaEgresoSpe($query,$fechaIngresoSpe)
    {
        if($fechaIngresoSpe) return $query->whereDate('egresados.fechaEgreso',$fechaIngresoSpe);
    }
    
    public function ScopeYearIngreso($query,$anioIngreso)
    {
        if($anioIngreso) return $query->whereYear('egresados.fechaIngreso',$anioIngreso);
    }

    public function ScopeYearEgreso($query,$anioEgreso)
    {
        if($anioEgreso) return $query->whereYear('egresados.fechaEgreso',$anioEgreso);
    }

    public function citas()
    {
        return $this->hasMany('App\Models\Cita');
    }
}