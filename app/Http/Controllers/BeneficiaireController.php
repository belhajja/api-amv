<?php

namespace App\Http\Controllers;

use App\Beneficiaire;
use App\Http\Resources\BeneficiaireCollection;
use App\Http\Resources\Beneficiaire As ResourcesBeneficiaire;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Bénéficiaire', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Bénéficiaire', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Bénéficiaire', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Bénéficiaire', ['only' => [
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
        $beneficiaires = Beneficiaire::with('adherent')->with('dossiers')->Filter()->get();

        return (new BeneficiaireCollection($beneficiaires))
        ->response()
        ->setStatusCode(200);

    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'relation' => 'required',
            'couverture' => 'required',
            'etat' => 'required',
            'adherent_id' => 'required'
        ]);

        $beneficiaire = Beneficiaire::create($request->all());

        return (new ResourcesBeneficiaire($beneficiaire))
        ->response()
        ->setStatusCode(200);
    }

    public function show(Beneficiaire $beneficiaire)
    {
        $beneficiaire = Beneficiaire::Filter()->find($beneficiaire)->first();

        if ($beneficiaire){
            return (new ResourcesBeneficiaire($beneficiaire))
            ->response()
            ->setStatusCode(200);
        }

        return HTTPReponse(403);
    }

    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        $request->validate([
            'nom' => 'nullable',
            'prenom' => 'nullable',
            'relation' => 'nullable',
            'couverture' => 'nullable',
            'etat' => 'nullable',
            'adherent_id' => 'nullable'
        ]);

        $beneficiaire->update($request->all());

        return (new ResourcesBeneficiaire($beneficiaire))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();

        return response()->json([
            'message' => 'Bénéficiaire supprimé avec succès!'
        ]);
    }
}
