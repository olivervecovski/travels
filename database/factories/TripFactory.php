<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip;
use App\User;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    $title = $faker->sentence();
    $start = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
    return [
        'name' => $title,
        'description' => $faker->text,
        'start_date' => $start,
        'end_date' => $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').'+2 days'),
        'image_url' => $faker->word,
        'user_id' => function() {
            return User::all()->random()->id;
        },
        'private' => $faker->boolean()
    ];
});
