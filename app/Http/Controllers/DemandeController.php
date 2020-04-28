<?php

namespace App\Http\Controllers;

use App\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::all();

        return response()->json($demandes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'objet' => 'required',
            'description' => 'required',
            'date_demande' => 'required',
            'statut' => 'required',
            'date_reponse' => 'required',
            'date_resolution' => 'required',
            'reponse' => 'required',
            'societe_id' => 'nullable',
            'adherent_id' => 'nullable',
            'dossier_id' => 'nullable',
        ]);

        $demande = Demande::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouvelle Demande crée',
            'contact' => $demande
        ]);
    }

    public function show(Demande $demande)
    {
        return $demande;
    }

    public function update(Request $request, Demande $demande)
    {
        $request->validate([
            'type' => 'nullable',
            'objet' => 'nullable',
            'description' => 'nullable',
            'date_demande' => 'nullable',
            'statut' => 'nullable',
            'date_reponse' => 'nullable',
            'date_resolution' => 'nullable',
            'reponse' => 'nullable',
            'societe_id' => 'nullable',
            'adherent_id' => 'nullable',
            'dossier_id' => 'nullable',
        ]);

        $demande->update($request->all());

        return response()->json([
            'message' => 'Succès ! Demande mise à jour',
            'demande' => $demande
        ]);
    }

    public function destroy(Demande $demande)
    {
        $demande->delete();

        return response()->json([
            'message' => 'Demande supprimée avec succès!'
        ]);
    }
}
