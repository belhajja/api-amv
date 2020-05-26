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

    public function scopeFilter($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('id', DB::table('societe_user')->where('user_id', $user->id)
                ->pluck('societe_id'));
        }
    }
}
