<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Document extends JsonResource
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
        $arrayData = [
            'id'    => $this->id,
            'name'  => $this->name,
            'path'  => $this->path,
            'size' => $this->size,
            'dossier_id' => $this->dossier_id,
            'demande_id' => $this->demande_id,
        ];

        return $arrayData;
    }
}
