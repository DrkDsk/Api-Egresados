<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    protected $fillable = [
        'name',
        'apellido1',
        'apellido2',
        'noControl',
        'movil',
        'telefono_casa',
        'email_alternativo',
        'carrera',
    ];

    public function ScopeTipo($query,$value,$tipo)
    {
        if($value) return $query->where($tipo,$value);
    }

    public function ScopeCarrera($query,$carrera)
    {
        if($carrera) return $query->where('carrera',$carrera);
    }

    public function ScopeFechaIngresoRange($query,$fechaIngresoRange)
    {
        if($fechaIngresoRange) return $query->whereDate('fechaIngreso','>=',$fechaIngresoRange);
    }

    public function ScopeFechaEgresoRange($query,$fechaEgresoRange)
    {
        if($fechaEgresoRange) return $query->whereDate('fechaEgreso','<=',$fechaEgresoRange);
    }
    
    public function ScopeFechaIngresoSpe($query,$fechaIngresoSpe)
    {
        if($fechaIngresoSpe) return $query->whereDate('fechaIngreso',$fechaIngresoSpe);
    }

    public function ScopeFechaEgresoSpe($query,$fechaIngresoSpe)
    {
        if($fechaIngresoSpe) return $query->whereDate('fechaEgreso',$fechaIngresoSpe);
    }
    
    public function ScopeYearIngreso($query,$anioIngreso)
    {
        if($anioIngreso) return $query->whereYear('fechaIngreso',$anioIngreso);
    }

    public function ScopeYearEgreso($query,$anioEgreso)
    {
        if($anioEgreso) return $query->whereYear('fechaEgreso',$anioEgreso);
    }
}