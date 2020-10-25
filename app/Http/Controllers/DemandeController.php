<?php

namespace App\Http\Controllers;

use App\Demande;
use App\Http\Resources\Demande as ResourcesDemande;
use App\Http\Resources\DemandeCollection;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view Demande', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Demande', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Demande', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Demande', ['only' => [
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
        $demandes = Demande::with('societe')->with('adherent')->with('dossier')->Filter()->get();
        //$adherents = Adherent::Filter()->get();

        //return $demandes;
        return (new DemandeCollection($demandes))
            ->response()
            ->setStatusCode(200);
    }

    public function getDemandeBySociete(Request $request)
    {
        $societe = $request->societe;

        $demandes = Demande::Societe()->where('societe_id','=',$societe)->get();

        return $demandes;
        //$adherent = Adherent::Filter()->find($adherent)->first();
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
        $demande = Demande::with('societe')->with('adherent')->with('dossier')->Filter()->find($demande)->first();
        //$adherent = Adherent::Filter()->find($adherent)->first();

        if ($demande) {
            return (new ResourcesDemande($demande))
                ->response()
                ->setStatusCode(200);
        }

        return HTTPReponse(403);
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
