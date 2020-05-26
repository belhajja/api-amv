<?php

namespace App\Http\Controllers;

use App\Adherent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdherentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Adhérent', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Adhérent', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Adhérent', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Adhérent', ['only' => [
            'destroy',
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $adherents = Adherent::Filter()->get();

        $adherents = Adherent::all();

        return response()->json($adherents);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            'matricule' => "required",
            'rib'=> "required",
            'situation'=> "required",
            'couverture'=> "required",
            'etat'=> "required",
            'date_adhesion'=> "required",
            'societe_id'=> "required"
        ]);

        $adherent = Adherent::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouveau Adhèrent crée',
            'adherent' => $adherent
        ]);
    }

    public function show(Adherent $adherent)
    {
        if (!$adherent){
            return response()->json([
                'message' => 'Objet inexistant'
            ],404);
        }
        
        return $adherent;
    }

    public function update(Request $request, Adherent $adherent)
    {
        $request->validate([
            "nom" => "nullable",
            "prenom" => "nullable",
            'matricule' => "nullable",
            'rib'=> "nullable",
            'situation'=> "nullable",
            'couverture'=> "nullable",
            'etat'=> "nullable",
            'date_adhesion'=> "nullable",
            'societe_id'=> "nullable"
        ]);

        $adherent->update($request->all());

        return response()->json([
            'message' => 'Succès ! Adherent mis à jour',
            'adherent' => $adherent
        ]);
    }

    public function destroy(Adherent $adherent)
    {
        $adherent->delete();

        return response()->json([
            'message' => 'Adhèrent supprimé avec succès!'
        ]);
    }

}
