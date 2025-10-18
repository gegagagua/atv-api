<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginErrorHandlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_invalid_credentials_returns_500()
    {
        $loginData = [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'არასწორი ქრედენციალები',
            ]);
    }

    public function test_login_with_wrong_password_returns_500()
    {
        // Create a user first
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'არასწორი ქრედენციალები',
            ]);
    }

    public function test_login_with_wrong_email_returns_500()
    {
        // Create a user first
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $loginData = [
            'email' => 'wrong@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'არასწორი ქრედენციალები',
            ]);
    }

    public function test_login_with_valid_credentials_returns_200()
    {
        // Create a user first
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Login successful',
            ])
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'user_type',
                    ],
                    'token',
                ]
            ]);
    }

    public function test_login_with_missing_credentials_returns_422()
    {
        $loginData = [
            'email' => 'test@example.com',
            // Missing password
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_login_with_invalid_email_format_returns_422()
    {
        $loginData = [
            'email' => 'invalid-email',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}