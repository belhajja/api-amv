<?php

namespace App\Http\Controllers;

use App\Adherent;
use App\Http\Resources\Adherent as ResourcesAdherent;
use App\Http\Resources\AdherentCollection;
use Illuminate\Http\Request;

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
        $adherents = Adherent::Filter()->get();

        return (new AdherentCollection($adherents))
            ->response()
            ->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            'matricule' => "required",
            'rib' => "required",
            'situation' => "required",
            'couverture' => "required",
            'etat' => "required",
            'date_adhesion' => "required",
            'societe_id' => "required"
        ]);

        $adherent = Adherent::create($request->all());

        return (new ResourcesAdherent($adherent))
            ->response()
            ->setStatusCode(200);
    }

    public function show(Adherent $adherent)
    {

        $adherent = Adherent::Filter()->find($adherent)->first();

        if ($adherent) {
            return (new ResourcesAdherent($adherent))
                ->response()
                ->setStatusCode(200);
        }

        return HTTPReponse(403);
    }

    public function update(Request $request, Adherent $adherent)
    {
        $request->validate([
            "nom" => "nullable",
            "prenom" => "nullable",
            'matricule' => "nullable",
            'rib' => "nullable",
            'situation' => "nullable",
            'couverture' => "nullable",
            'etat' => "nullable",
            'date_adhesion' => "nullable",
            'societe_id' => "nullable"
        ]);

        if (Adherent::Filter()->find($adherent)->first()) {
            if ($adherent->update($request->all())) {
                
                return (new ResourcesAdherent($adherent))
                    ->response()
                    ->setStatusCode(200);
            }
            return HTTPReponse(500);
        }

        return HTTPReponse(403);
    }

    public function destroy(Adherent $adherent)
    {

        if (Adherent::Filter()->find($adherent)->first()) {
            $adherent->delete();

            return HTTPReponse(204);
        }

        return HTTPReponse(403);
    }
}
