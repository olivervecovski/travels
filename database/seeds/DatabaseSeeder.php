<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Trip;
use App\Models\Destination;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create();
        factory(Trip::class, 50)->create()->each(function($trip) {
            return $trip->images()->saveMany(factory(Image::class, 1)->make(['type' => 'trip', 'td_id' => $trip->id]));
        });
        factory(Destination::class, 50)->create()->each(function($destination) {
            return $destination->images()->saveMany(factory(Image::class, 2)->make(['type' => 'destination', 'td_id' => $destination->id]));
        });
    }
}
