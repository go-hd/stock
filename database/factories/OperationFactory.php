<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Operation;
use Faker\Generator as Faker;

$factory->define(Operation::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween('-3 years');
    $updated_at = $faker->dateTimeBetween($created_at);

    return [
        'quantity' => $faker->numberBetween(0, 300) - 100,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
