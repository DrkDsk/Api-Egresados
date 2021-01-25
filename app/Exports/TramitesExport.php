<?php

namespace App\Exports;

use App\Models\Tramite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TramitesExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;
    protected $array;
    
    public function __construct($array)
    {
        $this->array = $array;
    }

    public function collection()
    {
        $tramites = collect($this->array);
        return $tramites;
    }

    public function map($tramites): array
    {
        return [
            
            $tramites->name,
            $tramites->apellido1,
            $tramites->apellido2,
            $tramites->noControl,
            $tramites->movil,
            $tramites->telefono_casa,
            $tramites->email,
            $tramites->email_alternativo,
            $tramites->carrera,
            $tramites->fechaIngreso,
            $tramites->fechaEgreso,
            $tramites->tipo,
        ];
    }

    public function headings(): array
    {
        return [
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
            'Trámite'
        ];
    }
}
