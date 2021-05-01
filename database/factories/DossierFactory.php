<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dossier;
use Faker\Generator as Faker;

$factory->define(Dossier::class, function (Faker $faker) {
    
    $adherent = \App\Adherent::all()->pluck('id')->toArray();
    $selected_adherent = $faker->randomElement($adherent);
    $beneficiaire = \App\Beneficiaire::all()->where('adherent_id',$selected_adherent)->pluck('id')->toArray();

    return [
        'adherent_id' => $selected_adherent,
        'beneficiaire_id' => $faker->boolean(50) ? $faker->randomElement($beneficiaire):null,
        'numero' => $faker->randomNumber(6,true),
        'statut' => $faker->randomElement(['RGL' , 'C.INF' , 'CV' , 'ACCORD' , 'EN COURS' , 'RETOUR CLT' , 'RGL EXCEPTIONNEL']),
        'etat_initiale' => $faker->randomElement(['A Titre Informative' , 'Complément Nécessaire' , 'Urgent' , 'RAS']),
        'date_depot' => $faker->date(),
        'date_sinistre' => $faker->date(),
        'type' => $faker->randomElement(['Devis' , 'Medical' , 'PEC' , 'Optique']),
        'date_sort' => $faker->date(),
        'frais' => $faker->randomNumber(4,true),
        'montant' => $faker->randomNumber(4,true),
        'reglement' => $faker->boolean,
        'mode_reglement' => $faker->randomElement(['Virement','Chèque','Espèce']),
        'pathologie' => $faker->sentence,
        'observation' => $faker->text,
    ];
});
