<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Societe extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //return parent::toArray($request);

        return [
            'id'            => $this->id,
            'numero_police' => $this->numero_police,
            'nom'           => $this->nom,
            'adresse'        => $this->adresse
            //'adherents'     => (new AdherentCollection($this->whenLoaded('adherents'))),
            //'demandes'      => (new DemandeCollection($this->whenLoaded('demandes')))
        ];
    }
}
