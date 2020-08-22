<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use GuzzleHttp\Client;

class LoginUser extends TestCase
{
    /**
     test
     *
     */
    public function test_login_user_with_correct_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'ritchie.coty@example.net',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'user' => [

            ],
            'access_token'
        ]);
    }

    public function test_login_user_with_incorrect_credentials() {
        $response = $this->post('/api/auth/login', [
            'email' => 'ritchie.coty@example.net',
            'password' => 'password123'
        ]);

        $response->assertStatus(404);
        $response->assertJsonStructure([
            'success',
            'message'
        ]);
    }
}
