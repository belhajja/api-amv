<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Societe extends Model
{
    /* protected $fillable = [
        'numero_police',
        'nom',
        'adresse'
    ]; */

    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function adherents()
    {
        return $this->hasMany(Adherent::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function scopeFilter($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('id', DB::table('societe_user')->where('user_id', $user->id)
                ->pluck('societe_id'));
        }
        if ($user->hasPermissionTo('Access User'))
        {
            $query->whereIn('id', DB::table('adherent_user')->where('user_id', $user->id)
            ->join('adherents','adherents.id','=','adherent_user.adherent_id')
            ->join('societes','adherents.societe_id','=','societes.id')
            ->pluck('societes.id'));
        }
    }
}
