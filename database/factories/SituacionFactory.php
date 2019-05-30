<?php

use Faker\Generator as Faker;

$factory->define(App\Situacion::class, function (Faker $faker) {
    return [
        'estado_civil' => $faker->name,
        'slug' => $faker->slug
    ];
});
