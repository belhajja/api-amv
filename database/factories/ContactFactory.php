<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    
    $societe = \App\Societe::all()->pluck('id')->toArray();
    
    return [
        'nom' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'numero' => $faker->phoneNumber,
        'poste' => $faker->jobTitle,
        'societe_id' => $faker->randomElement($societe)
    ];
});
