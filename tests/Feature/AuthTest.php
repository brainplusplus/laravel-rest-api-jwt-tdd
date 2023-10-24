<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_register_user(): void
    {

        $name = "User";
        $email = "user@user.com";
        $password = "password";

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson(['user'=>['name' => $name, 'email' => $email]]);

        $this->assertDatabaseHas('users', ['name' => $name, 'email' => $email]);
    }
}
