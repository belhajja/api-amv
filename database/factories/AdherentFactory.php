<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Adherent;
use Faker\Generator as Faker;

$factory->define(Adherent::class, function (Faker $faker) {

    $societe = \App\Societe::all()->pluck('id')->toArray();
    
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'matricule' => $faker->randomNumber(8),
        'rib' => $faker->randomNumber(9),
        'situation' => $faker->randomElement(['Célibataire', 'Marié', 'Divorcé' , 'Veuf']),
        'couverture' => $faker->randomElement(['Base', 'Complémentaire']),
        'etat' => $faker->randomElement(['En Cours', 'Sortant']),
        'date_adhesion' => $faker->date(),
        'societe_id' => $faker->randomElement($societe)
    ];
});
