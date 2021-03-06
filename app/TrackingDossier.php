<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrackingDossier extends Model
{
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function scopeFilter($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('dossier_id', DB::table('societe_user')->where('user_id', $user->id)
                ->join('adherents','adherents.societe_id','=','societe_user.societe_id')
                ->join('dossiers','dossiers.adherent_id','=','adherents.id')
                ->pluck('dossiers.id'));
        }
        else if (auth()->user()->hasPermissionTo('Access User'))
        {
            $query->whereIn('dossier_id', DB::table('adherent_user')->where('user_id', $user->id)
                ->join('adherents','adherents.id','=','adherent_user.adherent_id')
                ->join('dossiers','dossiers.adherent_id','=','adherents.id')
                ->pluck('dossiers.id'));
        }
    }

    
}
