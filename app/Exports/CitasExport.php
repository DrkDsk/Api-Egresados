<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CitasExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;
    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    
    public function collection()
    {
        $citas = collect($this->array);
        return $citas;
    }

    public function map($citas) : array
    {
        return [
            $citas->name,
            $citas->apellido1,
            $citas->apellido2,
            $citas->noControl,
            $citas->movil,
            $citas->telefono_casa,
            $citas->email,
            $citas->email_alternativo,
            $citas->carrera,
            $citas->fechaIngreso,
            $citas->fechaEgreso,
            $citas->tipo,
            $citas->descripcion,
            $citas->asunto,
            $citas->fecha,
            $citas->hora,
            
        ];
    }

    public function headings() : array
    {
        return[
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',
            'Número de Control',
            'Teléfono Móvil',
            'Teléfono de Casa',
            'Email Principal',
            'Email Alternativo',
            'Carrera',
            'Fecha de Ingreso',
            'Fecha de Egreso',
            'Trámite',
            'Descripción',
            'Asunto',
            'Fecha',
            'Hora',
        ];
    }
}
