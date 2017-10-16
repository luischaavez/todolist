<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        "task" => $faker->text,
        "completed" => false,
        "user_id" => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
