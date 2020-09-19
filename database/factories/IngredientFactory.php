<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'supplier' => $faker->word,
        'supplier_site_location' => $faker->sentence(3)
    ];
});
