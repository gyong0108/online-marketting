<?php

$factory->define(App\Campaign::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "keywords" => $faker->name,
        "daily_budget" => $faker->randomNumber(2),
        "title" => $faker->name,
        "undertitle" => $faker->name,
        "shortdescription" => $faker->name,
        "description" => $faker->name,
        "email" => $faker->safeEmail,
        "active" => 1,
        "created_by_id" => factory('App\User')->create(),
    ];
});
