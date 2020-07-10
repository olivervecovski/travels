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
        'image_url' => 'https://i.picsum.photos/id/10/2500/1667.jpg?hmac=J04WWC_ebchx3WwzbM-Z4_KC_LeLBWr5LZMaAkWkF68'
    ];
});
