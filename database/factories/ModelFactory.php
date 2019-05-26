<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Webserver::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->domainName,
        'port' => $faker->randomDigitNotNull,
        'userID' => $faker->userName,
        'password' => $faker->password,
    ];
});
