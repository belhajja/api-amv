<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Demande;
use Faker\Generator as Faker;

$factory->define(Demande::class, function (Faker $faker) {
    
    $adherent = \App\Adherent::all()->pluck('id')->toArray();
    $societe = \App\Societe::all()->pluck('id')->toArray();
    $dossier = \App\Dossier::all()->pluck('id')->toArray();
    $type = $faker->randomElement(['Dossier' , 'Adhérent' , 'Société']);
    
    return [
        'type' => $type,
        'objet' => $faker->sentence,
        'description' => $faker->paragraph(2),
        'date_demande' => $faker->date(),
        'statut' => $faker->randomElement(['En Cours' , 'Traitée']),
        'date_reponse' => $faker->date(),
        'date_resolution' => $faker->date(),
        'reponse' => $faker->paragraph,
        'societe_id' => ($type == 'Société')? $faker->randomElement($societe):NULL,
        'adherent_id' => ($type == 'Adhérent')? $faker->randomElement($adherent):NULL,
        'dossier_id' => ($type == 'Dossier')? $faker->randomElement($dossier):NULL,
        ];
});
