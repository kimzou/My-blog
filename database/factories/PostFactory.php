<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'username' => $faker->userName->unique(),
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->firstName,
        'lastname' => $faker->lastName,
        'birthdate' => '01/01/1990',
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});
