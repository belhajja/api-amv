<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
