<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListaTramite;

class ListTramitesController extends Controller
{
    public function getCreateTramite()
    {
        $listaTramites = ListaTramite::all();
        return view('tramites.create',[
            'tramites' => $listaTramites
        ]);
    }

    public function editListaTramite($id)
    {   
        $tramite = ListaTramite::where('id',$id)->first();
        return view('tramites.edit',['tramite' => $tramite]);
    }

    public function updateNameTramite(Request $request,$id)
    {
        $request->validate(['trámite' => 'required']);
        $tramite = ListaTramite::where('id',$id)->first();
        $tramite->name = $request->trámite;;
        $tramite->save();
        return redirect()->route('listaTramites');
    }

    public function storeTramite(Request $request)
    {   
        $validate = $request->validate(['trámite' => 'required']);
        $newTramite = ListaTramite::where('name',$request->trámite)->first();

        if(!$newTramite){
            $tramite = new ListaTramite();
            $tramite->name = $request->trámite;
            $tramite->save();
            return redirect()->back();
        }
        else return back()->withErrors([ 'trámite' => 'Trámite Existente' ]);
    }

    public function deleteListaTramite($id)
    {
        $tramites = ListaTramite::where('id',$id);
        $tramites->delete();
        return redirect()->back();
    }
}