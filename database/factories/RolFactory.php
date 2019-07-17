<?php

use Faker\Generator as Faker;

$factory->define(App\Rol::class, function (Faker $faker) {
    return [
        'nombre' => $faker->city,
        'descripcion' => $faker->text,
    ];
});
