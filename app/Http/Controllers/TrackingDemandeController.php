<?php

namespace App\Http\Controllers;

use App\TrackingDemande;
use Illuminate\Http\Request;

class TrackingDemandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Tracking Demande', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Tracking Demande', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Tracking Demande', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Tracking Demande', ['only' => [
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
        $trackingdemandes = TrackingDemande::all();

        return response()->json($trackingdemandes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_sort' => 'required',
            'date_sort' => 'required',
            'delai' => 'required',
            'medecin' => 'required',
            'motif' => 'required',
            'observation' => 'required',
            'hidden' => 'required',
            'dossier_id' => 'required',
        ]);

        $trackingdemande = TrackingDemande::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouvelle Suivi Demande crée',
            'trackingdemande' => $trackingdemande
        ]);
    }

    public function show(TrackingDemande $trackingdemande)
    {
        return $trackingdemande;
    }

    public function update(Request $request, TrackingDemande $trackingdemande)
    {
        $request->validate([
            'type_sort' => 'nullable',
            'date_sort' => 'nullable',
            'delai' => 'nullable',
            'medecin' => 'nullable',
            'motif' => 'nullable',
            'observation' => 'nullable',
            'hidden' => 'nullable',
            'dossier_id' => 'nullable'
        ]);

        $trackingdemande->update($request->all());

        return response()->json([
            'message' => 'Succès ! Suivi Demande mis à jour',
            'trackingdemande' => $trackingdemande
        ]);
    }

    public function destroy(TrackingDemande $trackingdemande)
    {
        $trackingdemande->delete();

        return response()->json([
            'message' => 'Suivi Demande supprimé avec succès!'
        ]);
    }
}
