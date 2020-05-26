<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public function scopeFilter($query)
    {
        $user = auth()->user();

        if ($user->hasPermissionTo('Access Manager'))
        {
            $query->whereIn('societe_id', DB::table('societe_user')->where('user_id', $user->id)
                ->pluck('societe_id'));
        }

    }
}
