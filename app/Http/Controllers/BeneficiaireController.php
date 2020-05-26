<?php

namespace App\Http\Controllers;

use App\Beneficiaire;
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
        return Beneficiaire::Filter()->get();

        $beneficiaires = Beneficiaire::all();

        return response()->json($beneficiaires);
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

        return response()->json([
            'message' => 'succès ! Nouveau Bénéficiaire crée',
            'adherent' => $beneficiaire
        ]);
    }

    public function show(Beneficiaire $beneficiaire)
    {
        return $beneficiaire;
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

        return response()->json([
            'message' => 'Succès ! Bénéficiaire mis à jour',
            'beneficiaire' => $beneficiaire
        ]);
    }

    public function destroy(Beneficiaire $beneficiaire)
    {
        $beneficiaire->delete();

        return response()->json([
            'message' => 'Bénéficiaire supprimé avec succès!'
        ]);
    }
}
