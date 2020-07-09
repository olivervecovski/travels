<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use App\Models\Destination;
use App\Models\Trip;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $imageable = [
        Destination::class,
        Trip::class
    ];

    return [
        'description' => $faker->text,
        'size' => 0,
        'imageable_id' => $faker->numberBetween(0, 50),
        'imageable_type' => $faker->randomElement($imageable),
        'image_url' => $faker->image('public/storage/images', 400,300)
    ];
});
