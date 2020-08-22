<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Trip;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class TripsTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_list_trips() {

        $this->get('/api/trips')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [ 'title', 'id', 'description', 'start_date' ],
            ]);
    }

    public function test_can_create_trip_with_minimum_requirements() {
        $data = [
            'name' => $this->faker->sentence,
            // 'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('now', '1 month')
        ];

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->post('/api/trips', $data)
        ->assertJsonStructure(
            [ 'success', 'message', 'trip' => [] ]
        );
    }

    public function test_can_create_trip_with_all_fields() {
        $data = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('now', '1 month'),
            'end_date' => $this->faker->dateTimeBetween('1 month', '2 months'),
            'private' => true,
            'image_url' => 'https://homepages.cae.wisc.edu/~ece533/images/airplane.png'
        ];

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->post('/api/trips', $data)
        ->assertStatus(201)
        ->assertJsonStructure(
            [ 'success', 'message', 'trip' => [] ]
        );
    }

    public function test_cannot_create_trip_without_required_fields() {
        $data = [
            'start_date' => $this->faker->dateTimeBetween('now', '1 month')
        ];

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->post('/api/trips', $data)
        ->assertStatus(302)
        ->assertSessionHasErrors(
            [ 'name']
        );
    }

    public function test_can_update_trip() {

        Passport::actingAs(
            factory(User::class)->create()
        );

        $trip = factory(Trip::class)->create(['user_id' => Auth::id()]);
        $trip->name = "Updated name";

        $this->put('/api/trips/' .$trip->id, $trip->toArray())
        ->assertStatus(200);

        $this->assertDatabaseHas('trips', ['id' => $trip->id, 'name' => 'Updated name']);
    }

    public function test_user_cannot_update_another_users_trips(){
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        $trip_name = $trip->name;

        Passport::actingAs(
            factory(User::class)->create()
        );

        $trip->name = 'Updated name';

        $this->put('/api/trips/' .$trip->id, $trip->toArray())
        ->assertStatus(403);

        $this->assertDatabaseHas('trips', ['id' => $trip->id, 'name' => $trip_name]);

    }

    public function test_can_delete_trips(){
        Passport::actingAs(
            factory(User::class)->create()
        );

        $trip = factory(Trip::class)->create(['user_id' => Auth::id()]);

        $this->delete('/api/trips/' .$trip->id)
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message'
        ]);
    }

    public function test_cannot_delete_others_trips() {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->delete('/api/trips/' .$trip->id)
        ->assertStatus(403);

        $this->assertDatabaseHas('trips', ['id' => $trip->id]);
    }

    public function test_public_trips_are_viewable() {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(['user_id' => $user->id, 'private' => false]);

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->get('/api/trips/' .$trip->id)
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'trip'
        ]);
    }

    public function test_owner_of_private_trip_can_view() {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(['user_id' => $user->id, 'private' => true]);

        Passport::actingAs(
            $user
        );

        $this->get('/api/trips/' .$trip->id)
        ->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'trip'
        ]);
    }

    public function test_nonOwner_cannot_view_private_trip() {
        $user = factory(User::class)->create();
        $trip = factory(Trip::class)->create(['user_id' => $user->id, 'private' => true]);

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->get('/api/trips/' .$trip->id)
        ->assertStatus(403)
        ->assertJsonStructure([
            'success',
            'message'
        ]);
    }
}
