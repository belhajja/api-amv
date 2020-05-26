<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adherent extends Model
{
     /* protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'rib',
        'situation',
        'couverture',
        'etat',
        'date_adhesion',
        'societe_id'
    ]; */

    protected $guarded = [];

    protected $hidden = ['pivot'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function societes()
    {
        return $this->belongsToMany(Societe::class);
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
