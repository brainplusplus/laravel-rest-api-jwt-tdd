<?php

namespace Tests\Unit;

use App\Models\User;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
   use RefreshDatabase;

    public function test_create_user(): void
    {
        $name = "Muhammad Tri Wibowo";
        $email = "bowo@email.com";
        $password = "password";
        
        $user = User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // dump($user);


        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);
    }
}
