<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Demande extends Model
{
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function scopeFilterSociete($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('societe_id', DB::table('societe_user')->where('user_id', $user->id)
                ->pluck('societe_id'));
        }

    }

    public function scopeFilterAdherent($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('adherent_id', DB::table('societe_user')->where('user_id', $user->id)
                ->join('adherents','adherents.societe_id','=','societe_user.societe_id')
                ->pluck('adherents.id'));
        }
        else if (auth()->user()->hasPermissionTo('Access User'))
        {
            $query->whereIn('adherent_id', DB::table('adherent_user')->where('user_id', $user->id)
                ->join('adherents','adherents.id','=','adherent_user.adherent_id')
                ->pluck('adherents.id'));
        }
    }

    public function scopeFilterDossier($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('adherent_id', DB::table('societe_user')->where('user_id', $user->id)
                ->join('adherents','adherents.societe_id','=','societe_user.societe_id')
                ->pluck('adherents.id'));
        }
        else if (auth()->user()->hasPermissionTo('Access User'))
        {
            $query->whereIn('adherent_id', DB::table('adherent_user')->where('user_id', $user->id)
                ->join('adherents','adherents.id','=','adherent_user.adherent_id')
                ->pluck('adherents.id'));
        }
    }

    public function scopeSociete($query)
    {
        return $query->where('type', '=', 'Société');
    }

    public function scopeAdherent($query)
    {
        return $query->where('type', '=', 'Adhérent');
    }

    public function scopeDossier($query)
    {
        return $query->where('type', '=', 'Dossier');
    }

    public function scopeFilter($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('id', DB::table('societe_user')->where('user_id', $user->id)
                ->join('adherents','adherents.societe_id','=','societe_user.societe_id')
                ->pluck('adherents.id'));
        }
        else if (auth()->user()->hasPermissionTo('Access User'))
        {
            $query->whereIn('id', DB::table('adherent_user')->where('user_id', $user->id)
                ->join('adherents','adherents.id','=','adherent_user.adherent_id')
                ->pluck('adherents.id'));
        }
    }
}
