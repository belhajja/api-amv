<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {

    $dossier = \App\Dossier::all()->pluck('id')->toArray();
    $demande = \App\Demande::all()->pluck('id')->toArray();
    $type = $faker->randomElement(['Dossier' , 'Demande']);

    return [
        'name' => $faker->name,
        'path' => $faker->name,
        'size' => $faker->randomNumber(4,true),
        'dossier_id' => ($type == 'Dossier')? $faker->randomElement($dossier):NULL,
        'demande_id' => ($type == 'Demande')? $faker->randomElement($demande):NULL
        ];
});
