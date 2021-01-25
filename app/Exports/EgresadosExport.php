<?php

namespace App\Exports;

use App\Models\Egresado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EgresadosExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;
    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function collection()
    {
        $egresados = collect($this->array);
        return $egresados;
    }

    public function map($egresados): array
    {
        return [
            $egresados->name,
            $egresados->apellido1,
            $egresados->apellido2,
            $egresados->noControl,
            $egresados->movil,
            $egresados->telefono_casa,
            $egresados->email,
            $egresados->email_alternativo,
            $egresados->carrera,
            $egresados->fechaIngreso,
            $egresados->fechaEgreso,
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
            'Fecha de Egreso'
        ];
    }
}