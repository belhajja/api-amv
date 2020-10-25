<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocieteCollection;
use App\Http\Resources\Societe as ResourcesSociete;
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
        $societes = Societe::with('adherents')->with('demandes')->Filter()->get();
        //$societes = Societe::Filter()->get();

        return (new SocieteCollection($societes))
        ->response()
        ->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=> 'required',
            'numero_police' => 'required',
            'adresse' => 'required'
        ]);

        $societe = Societe::create($request->all());

        return (new ResourcesSociete($societe))
        ->response()
        ->setStatusCode(200);
    }

    public function show(Societe $societe)
    {
        $societe = Societe::with('adherents')->Filter()->find($societe)->first();

        if ($societe){
            return (new ResourcesSociete($societe))
            ->response()
            ->setStatusCode(200);
        }

        return HTTPReponse(403);
    }

    public function update(Request $request, Societe $societe)
    {
        $request->validate([
            'nom'=> 'nullable',
            'numero_police' => 'nullable',
            'adresse' => 'nullable'
        ]);
        
        $societe->update($request->all());

        return (new ResourcesSociete($societe))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(Societe $societe)
    {
        if (Societe::Filter()->find($societe)->first())
        {
            $societe->delete();

            return HTTPReponse(204);
        }

        return HTTPReponse(403);
    }
}
