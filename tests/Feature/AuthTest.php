<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    const NAME = "User";
    const EMAIL = "user@user.com";
    const PASSWORD = "password";
    
    /**
     * A basic feature test example.
     */
    protected function seed_user(): void
    {        
        $userData = [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => Hash::make(self::PASSWORD)
        ];

        User::create($userData);
    }
    
    public function test_it_can_register_user(): void
    {

        $userData = [
            'name' => self::NAME,
            'email' => self::EMAIL,
            'password' => self::PASSWORD
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson(['user'=>['name' => self::NAME, 'email' => self::EMAIL]]);

        $this->assertDatabaseHas('users', ['name' => self::NAME, 'email' => self::EMAIL]);

    }

    public function test_it_can_be_login(): void 
    {
        $this->seed_user();

        $userData = [
            'email' => self::EMAIL,
            'password' => self::PASSWORD
        ];

        $response = $this->json('POST', '/api/login', $userData);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['authorization' => [
                'token', 'type', 'expires_in'
            ]]);
    }

    public function test_it_can_be_logout(): void
    {
        $this->seed_user();

        $user = User::where('email', self::EMAIL)->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/logout');
        $response->assertStatus(200)
            ->assertJson(['message' => 'Successfully logged out']);
    }

    public function test_it_can_be_refresh_token(): void 
    {
        $this->seed_user();

        $user = User::where('email', self::EMAIL)->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/refresh');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['authorization' => [
                'token', 'type', 'expires_in'
            ]]);
    }
}
