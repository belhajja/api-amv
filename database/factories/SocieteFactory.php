<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Societe;
use Faker\Generator as Faker;

$factory->define(Societe::class, function (Faker $faker) {
   
    return [
        'nom'=> $faker->company,
        'numero_police' => $faker->randomNumber(6),
        'adresse' => $faker->address
    ];
});
