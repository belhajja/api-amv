<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TrackingDossier;
use Faker\Generator as Faker;

$factory->define(TrackingDossier::class, function (Faker $faker) {
    
    $dossier = \App\Dossier::all()->pluck('id')->toArray();

    return [
        'type_sort' => $faker->randomElement(['Contre Visite' , 'Complement Information' , 'Accord' , 'Rejet' , 'Retour Dossier' , 'Autre']),
        'date_sort' => $faker->date(),
        'delai' => $faker->randomNumber(2),
        'medecin' => $faker->name,
        'motif' => $faker->sentence,
        'observation' => $faker->text,
        'hidden' => $faker->boolean,
        'dossier_id' => $faker->randomElement($dossier),
    ];
});
