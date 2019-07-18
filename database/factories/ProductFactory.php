<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' => Str::random($faker->numberBetween(8, 12)),
        'jan' => $faker->ean13,
        'asin' => 'b' . strtolower(Str::random(9)),
        'name' => $faker->words($faker->numberBetween(1, 3), true),
        'code' => $faker->randomElement(['l', 'c', 't']) . '-' . $faker->numberBetween(100, 999),
    ];
});
