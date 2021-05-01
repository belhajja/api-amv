<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dossier extends JsonResource
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
            'id'                => $this->id,
            'numero'            => $this->numero,
            'statut'            => $this->statut,
            'etat_initiale'     => $this->etat_initiale,
            'date_depot'        => $this->date_depot,
            'date_sinistre'     => $this->date_sinistre,
            'type'              => $this->type,
            'date_sort'         => $this->date_sort,
            'frais'             => $this->frais,
            'mode_reglement'    => $this->mode_reglement,
            'reglement'         => $this->reglement,
            'pathologie'        => $this->pathologie,
            'observation'       => $this->observation,
            'adherent_id'       => $this->adherent_id,
            'beneficiaire_id'   => $this->beneficiaire_id
        ];
    }
}
