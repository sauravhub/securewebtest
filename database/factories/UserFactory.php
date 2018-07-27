<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'njNIHsAYuRb6x8ItVQRHcIn6E30sQPMQANYk0q0HK7lPrQyE7jJNtafM4bEW', // 123456
        'remember_token' => str_random(10),
    ];
});
