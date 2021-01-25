<?php

use Illuminate\Database\Seeder;

use App\Models\ListaCarrera;
use App\Models\ListaTramite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $arrayCarreras = [
            'Ing. En Sistemas Computacionales',
            'Ing. Mecánica',
            'Ing. Química',
            'Ing. Bioquímica',
            'Ing. Electrica',
            'Ing. Electrónica',
            'Ing. En Gestión Empresarial',
            "Ing. Industrial",
            'Ing. Logística'
        ];

        $arrayTramites =  [
            'Programación de Examen Profesional',
            'Constancia de Acreditación',
            'Titulación'
        ];

        DB::table('lista_carreras')->delete();
        DB::table('lista_tramites')->delete();

        foreach ($arrayCarreras as $carrera)
            ListaCarrera::create(['name' => $carrera]);
        
        foreach ($arrayTramites as $tramite)
            ListaTramite::create(['name' => $tramite]);

        User::create([
            'email' => 'admin@app.com',
            'password' => Hash::make("password"),
            'is_admin' => 1
        ]);
    }
}