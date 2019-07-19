<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $code = $faker->randomElement(['L', 'C', 'T']) . $faker->numberBetween(100, 999);
    $sku = strtolower($code);

    $basePrice = $faker->numberBetween(11, 99) / 10;
    $unit = (10 ** $faker->numberBetween(2, 4));
    $taxAdjustment = $faker->randomElement([1.08, 1]);
    $marketingAdjustment = $faker->randomElement([0.02, 0, 0.1 / $unit]);
    $price = ($basePrice  - $marketingAdjustment) * $unit / $taxAdjustment;

    return [
        'sku' => $sku,
        'jan' => $faker->randomElement(['45', '49']) . $faker->numberBetween(10000000000, 99999999999),
        'asin' => 'B' . $faker->numberBetween(10, 99) . strtoupper(Str::random(7)),
        'name' => $faker->words($faker->numberBetween(2, 3), true),
        'code' => $code,
        'price' => $price,
    ];
});
