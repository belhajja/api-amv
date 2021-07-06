<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Beneficiaire;
use Faker\Generator as Faker;

$factory->define(Beneficiaire::class, function (Faker $faker) {

    $adherent = \App\Adherent::all()->pluck('id')->toArray();
    
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'relation' => $faker->randomElement(['Conjoint' , 'Enfant']),
        'couverture' => $faker ->randomElement(['Base' , 'Complémentaire']),
        'etat' => $faker->randomElement(['En Cours' , 'Sortant']),
        'date_naissance' => $faker->date,
        'adherent_id' => $faker->randomElement($adherent)
    ];
});
