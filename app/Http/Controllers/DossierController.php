<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Http\Resources\DossierCollection;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:view Dossier', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Dossier', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Dossier', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Dossier', ['only' => [
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

        $dossiers = Dossier::with('adherent')->with('beneficiaire')->with('demandes')->Filter()->get();

        return (new DossierCollection($dossiers))
            ->response()
            ->setStatusCode(200);
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'adherent_id' => 'required',
            'beneficiaire_id' => 'nullable',
            'numero' => 'required',
            'statut' => 'required',
            'etat_initiale' => 'required',
            'date_depot' => 'required',
            'date_sinistre' => 'required',
            'type' => 'required',
            'date_sort' => 'required',
            'frais' => 'required',
            'reglement' => 'required',
            'mode_reglement' => 'required',
            'pathologie' => 'required',
            'observation' => 'required',
        ]);

        $dossier = Dossier::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouveau Dossier crée',
            'dossier' => $dossier
        ]);
    }

    public function show(Dossier $dossier)
    {
        return $dossier;
    }

    public function update(Request $request, Dossier $dossier)
    {
        $request->validate([
            'adherent_id' => 'nullable',
            'beneficiaire_id' => 'nullable',
            'numero' => 'nullable',
            'statut' => 'nullable',
            'etat_initiale' => 'nullable',
            'date_depot' => 'nullable',
            'date_sinistre' => 'nullable',
            'type' => 'nullable',
            'date_sort' => 'nullable',
            'frais' => 'nullable',
            'reglement' => 'nullable',
            'mode_reglement' => 'nullable',
            'pathologie' => 'nullable',
            'observation' => 'nullable',
        ]);

        $dossier->update($request->all());

        return response()->json([
            'message' => 'Succès ! Dossier mis à jour',
            'dossier' => $dossier
        ]);
    }

    public function destroy(Dossier $dossier)
    {
        $dossier->delete();

        return response()->json([
            'message' => 'Dossier supprimé avec succès!'
        ]);
    }
}
