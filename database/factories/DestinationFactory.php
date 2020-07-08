<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Destination;
use App\Models\Trip;
use Faker\Generator as Faker;

$factory->define(Destination::class, function (Faker $faker) {
    $start = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
    return [
        'longitude' => 0,
        'latitude' => 0,
        'description' => $faker->text,
        'start_date' => $start,
        'end_date' => $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s'). '+2 days'),
        'trip_id' => function() {
            return Trip::all()->random()->id;
        }
    ];
});
