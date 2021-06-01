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

        //$demandes = Demande::Filter()->get();
        $demandes = Demande::with('documents')->Filter()->get();

        return (new DemandeCollection($demandes))
            ->response()
            ->setStatusCode(200);
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

        return (new ResourcesDemande($demande))
        ->response()
        ->setStatusCode(200);
    }

    public function show(Demande $demande)
    {
        $demande = Demande::Filter()->find($demande)->first();

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

        return (new ResourcesDemande($demande))
                ->response()
                ->setStatusCode(200);
    }

    public function destroy(Demande $demande)
    {
        $demande->delete();

        return HTTPReponse(204);
    }
}
