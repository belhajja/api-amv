<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\Contact As ResourcesContact;
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

        $contacts = Contact::Filter()->get();

        return (new ResourcesContact($contacts))
        ->response()
        ->setStatusCode(200);
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

        return (new ResourcesContact($contact))
        ->response()
        ->setStatusCode(200);
    }

    public function show(Contact $contact)
    {
        $contact = Contact::Filter()->find($contact)->first();

        if ($contact) {
            return (new ResourcesContact($contact))
            ->response()
            ->setStatusCode(200);
        }

        return HTTPReponse(403);
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

        return (new ResourcesContact($contact))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(Contact $contact)
    {
        if (Contact::Filter()->find($contact)->first()) {
            $contact->delete();

            return HTTPReponse(204);
        }

        return HTTPReponse(403);
    }

}
