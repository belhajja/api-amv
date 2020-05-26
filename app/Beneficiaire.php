<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Beneficiaire extends Model
{
    //protected $fillable = []

    protected $guarded = [];

    protected $hidden = ['pivot'];

    
    public function scopeFilter($query)
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
}
