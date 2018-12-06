<?php

$factory->define(App\Request::class, function (Faker\Generator $faker) {
    return [
        "landingpage" => $faker->name,
        "target" => collect(["contacts","infos","views","clicks","subscriber",])->random(),
        "city" => $faker->name,
        "not_clear" => $faker->name,
        "no_phonenumber" => 0,
        "no_email" => 0,
        "no_form" => 0,
        "no_content" => 0,
        "no_faq" => 0,
        "adgroup_id" => factory('App\Campaign')->create(),
        "other_keywords" => $faker->name,
        "aswered" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "created_by_id" => factory('App\User')->create(),
    ];
});
