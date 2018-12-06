<?php

$factory->define(App\StripeTransaction::class, function (Faker\Generator $faker) {
    return [
        "transaction_user_id" => factory('App\User')->create(),
        "amount" => $faker->randomNumber(2),
    ];
});
