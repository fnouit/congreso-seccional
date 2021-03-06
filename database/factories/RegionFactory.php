<?php

use Faker\Generator as Faker;

$factory->define(App\Region::class, function (Faker $faker) {
    return [
        'nombre' => $faker->city,
        'sede' => $faker->city,
        'coordinador' => $faker->name,    
        'email' => $faker ->email,
        'telefono' => $faker ->phoneNumber,            
        'slug' => $faker ->slug,  
    ];    
});