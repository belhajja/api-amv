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
            'Nom'           => $this->nom,
            'Prenom'        => $this->prenom,
            'Matricule'     => $this->matricule,
            'Rib'           => $this->rib,
            'Situation'     => $this->situation,
            'Couverture'    => $this->couverture,
            'Etat'          => $this->etat,
            'Adhesion'      => $this->date_adhesion,
            'Société'       => (new Societe($this->whenLoaded('societe'))),
            'Bénéficiaires' => (new BeneficiaireCollection($this->whenLoaded('beneficiaires')))
        ];

    }
}
