<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Demande extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayData = [
            'id'                => $this->id,
            'type'              => $this->type,
            'objet'             => $this->objet,
            'description'       => $this->description,
            'date_demande'      => $this->date_demande,
            'statut'            => $this->statut,
            'date_reponse'      => $this->date_reponse,
            'date_resolution'   => $this->date_resolution,
            'reponse'           => $this->reponse,
        ];

        if ($this->societe_id != null) {
            $arrayData['societe'] = (new Societe($this->whenLoaded('societe')));
        }
        if ($this->adherent_id != null) {
            $arrayData['adherent'] = (new Adherent($this->whenLoaded('adherent')));
        }
        if ($this->dossier_id != null) {
            $arrayData['dossier'] = (new Dossier($this->whenLoaded('dossier')));
        }

        return $arrayData;
    }
}
