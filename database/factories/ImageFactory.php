<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use App\Models\Destination;
use App\Models\Trip;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $type = $faker->randomElement(['trip', 'destination']);
    return [
        'description' => $faker->text,
        'size' => 0,
        'image_url' => $faker->image('public/storage/images', 400,300)
    ];
});
