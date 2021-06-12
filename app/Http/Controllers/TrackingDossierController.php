<?php

namespace App\Http\Controllers;

use App\TrackingDossier;
use Illuminate\Http\Request;

use App\Http\Resources\TrackingDossierCollection;
use App\Http\Resources\TrackingDossier as ResourcesTrackingDossier;

class TrackingDossierController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Tracking Dossier', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Tracking Dossier', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Tracking Dossier', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Tracking Dossier', ['only' => [
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
        $trackingdossiers = TrackingDossier::Filter()->get();

        return (new TrackingDossierCollection($trackingdossiers))
        ->response()
        ->setStatusCode(200);
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

        $trackingdossier = TrackingDossier::create($request->all());

        return (new ResourcesTrackingDossier($trackingdossier))
        ->response()
        ->setStatusCode(200);
    }

    public function show(TrackingDossier $trackingdossier)
    {

        $trackingdossier = TrackingDossier::Filter()->find($trackingdossier)->first();

        if ($trackingdossier) {
            return (new ResourcesTrackingDossier($trackingdossier))
            ->response()
            ->setStatusCode(200);
        }

        return HTTPReponse(403);
    }

    public function update(Request $request, TrackingDossier $trackingdossier)
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

        $trackingdossier->update($request->all());

        return (new ResourcesTrackingDossier($trackingdossier))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(TrackingDossier $trackingdossier)
    {
        if (TrackingDossier::Filter()->find($trackingdossier)->first())
        {
            $trackingdossier->delete();

            return HTTPReponse(204);
        }

        return HTTPReponse(403);
    }
}
