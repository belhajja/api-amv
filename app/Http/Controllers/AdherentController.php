<?php

namespace App\Http\Controllers;

use App\Adherent;
use Illuminate\Http\Request;

class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
