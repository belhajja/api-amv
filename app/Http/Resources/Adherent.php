<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Adherent extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'societe_id'    => $this->societe_id,
            'nom'           => $this->nom,
            'prenom'        => $this->prenom,
            'matricule'     => $this->matricule,
            'rib'           => $this->rib,
            'situation'     => $this->situation,
            'couverture'    => $this->couverture,
            'etat'          => $this->etat,
            'date_adhesion' => $this->date_adhesion,
            //'societe'       => (new Societe($this->whenLoaded('societe'))),
            //'demandes'      => (new DemandeCollection($this->whenLoaded('demandes'))),
            //'beneficiaires' => (new BeneficiaireCollection($this->whenLoaded('beneficiaires'))),
            //'dossiers' => (new BeneficiaireCollection($this->whenLoaded('dossiers')))
        ];

    }
}
