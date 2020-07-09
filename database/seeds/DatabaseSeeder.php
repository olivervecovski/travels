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
        factory(Trip::class, 50)->create();
        factory(Destination::class, 50)->create();
        factory(Image::class, 50)->create();
    }
}
