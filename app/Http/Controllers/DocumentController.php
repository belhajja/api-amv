<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Resources\Document as ResourcesDocument;
use File;
use Illuminate\Http\Request;
use Response;
use Storage;
use Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'file' => 'required|mimes:doc,docx,pdf,txt',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        if ($files = $request->file('file')) {

            //store file into document folder
            $file = $request->file->store('public/documents');

            //store your file into database
            $document = new Document();
            $document->name = $files->getClientOriginalName();
            $document->path = basename($file);
            $document->size = $files->getSize();
            $document->dossier_id = $request->dossier;
            $document->demande_id = $request->demande;

            $document->save();

            return (new ResourcesDocument($document))
                ->response()
                ->setStatusCode(200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(String $file)
    {

        $filename = "public/documents/" . $file;

        return Storage::download($filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $document = Document::find($request->id)->first();

        $filename = "public/documents/" . $request->path;

        //return Storage::exists($filename);
        if (Storage::exists($filename)) {
            Storage::delete($filename);
            $document->delete();
        } else {
            return HTTPReponse(404);
        }

        return HTTPReponse(204);
    }
}
