<?php

namespace App\Http\Controllers;

use App\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Société', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Société', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Société', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Société', ['only' => [
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
        $societes = Societe::all();

        return response()->json($societes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=> 'required',
            'numero_police' => 'required',
            'adresse' => 'required'
        ]);

        $societe = Societe::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouvelle Société crée',
            'societe' => $societe
        ]);
    }

    public function show(Societe $societe)
    {
        return $societe;
    }

    public function update(Request $request, Societe $societe)
    {
        $request->validate([
            'nom'=> 'nullable',
            'numero_police' => 'nullable',
            'adresse' => 'nullable'
        ]);
        
        $societe->update($request->all());

        return response()->json([
            'message' => 'Succès ! Société mise à jour',
            'societe' => $societe
        ]);
    }

    public function destroy(Societe $societe)
    {
        $societe->delete();

        return response()->json([
            'message' => 'Société supprimée avec succès!'
        ]);
    }
}
