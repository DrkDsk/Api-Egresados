<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = ['tramite_id','fecha','descripcion'];

    public function tramites()
    {
        return $this->belongsTo('App\Models\Tramite');
    }

    public function ScopeTipo($query,$tipo)
    {
        if($tipo) return $query->where('tramites.tipo',$tipo);
    }

    public function ScopeCarrera($query,$carrera)
    {
        if($carrera) return $query->where('egresados.carrera',$carrera);
    }
}