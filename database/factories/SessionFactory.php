<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Session;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Session::class, function (Faker $faker) {
    return [
        'duration' => 60,
        'name' => $faker->sentence
    ];
});
