<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Egresado;
use App\Models\Tramite;
use App\Models\Cita;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $noUsuarios   = User::where('is_admin',0)->count();
        $noEgresados  = Egresado::all()->count();
        $noTramites = Tramite::all()->count();
        $noCitas      = Cita::all()->count();
        $newUsers     = $this->getNewUsers();
        $newEgresados = $this->getNewEgresados();
        $newTramites  = $this->getNewTramites();
        $newCitas     = $this->getNewCitas();
        
        return view('dashboard',[
            'noUsuarios'   => $noUsuarios,
            'noEgresados'  => $noEgresados,
            'noTramites' =>   $noTramites,
            'noCitas'      => $noCitas,
            'newUsers'     => $newUsers,            
            'newEgresados' => $newEgresados,
            'newTramites'  => $newTramites,
            'newCitas'     => $newCitas
        ]);
    }

    public function getNewUsers()
    {
        return User::where('created_at', '>=', Carbon::today())->count();
    }

    public function getNewEgresados()
    {
        return Egresado::where('created_at','>=',Carbon::today())->count();
    }

    public function getNewTramites(Type $var = null)
    {
        return Tramite::where('created_at','>=',Carbon::today())->count();
    }

    public function getNewCitas()
    {
        return Cita::where('created_at','>=',Carbon::today())->count();
    }
}
