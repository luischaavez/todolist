<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        "body" => $faker->text,
        "completed" => false,
        "user_id" => function() {
            return factory(App\User::class)->create()->id;
        },
        "project_id" => function() {
            return null;
        }
    ];
});
