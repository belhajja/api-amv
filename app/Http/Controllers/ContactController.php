<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view Contact', ['only' => [
            'index',
            'show',
        ]]);

        $this->middleware('permission:create Contact', ['only' => [
            'store',
        ]]);

        $this->middleware('permission:edit Contact', ['only' => [
            'update',
        ]]);

        $this->middleware('permission:delete Contact', ['only' => [
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

        return Contact::Filter()->get();
        $contacts = Contact::all();

        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'mail' => 'required',
            'numero' => 'required',
            'poste' => 'required',
            'societe_id' => 'required'
        ]);

        $contact = Contact::create($request->all());

        return response()->json([
            'message' => 'succès ! Nouveau Contact crée',
            'contact' => $contact
        ]);
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'nom' => 'nullable',
            'mail' => 'nullable',
            'numero' => 'nullable',
            'poste' => 'nullable',
            'societe_id' => 'nullable'
        ]);

        $contact->update($request->all());

        return response()->json([
            'message' => 'Succès ! Contact mis à jour',
            'contact' => $contact
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'message' => 'Contact supprimé avec succès!'
        ]);
    }

}
