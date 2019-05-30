<?php

use Faker\Generator as Faker;

$factory->define(App\Estudio::class, function (Faker $faker) {
    return [
        'maximo_estudio' => $faker->name,
        'slug' => $faker->slug
    ];
});
