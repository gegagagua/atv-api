<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPhoneFieldTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration_with_phone()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+995 555 123 456',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => [
                    'user' => [
                        'name' => 'John Doe',
                        'email' => 'john@example.com',
                        'phone' => '+995 555 123 456',
                        'user_type' => 'user',
                    ]
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'phone' => '+995 555 123 456',
        ]);
    }

    public function test_user_registration_without_phone()
    {
        $userData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => [
                    'user' => [
                        'name' => 'Jane Doe',
                        'email' => 'jane@example.com',
                        'phone' => null,
                        'user_type' => 'user',
                    ]
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'jane@example.com',
            'phone' => null,
        ]);
    }

    public function test_phone_validation_rules()
    {
        // Test phone too long
        $userData = [
            'name' => 'Test User',
            'email' => 'test1@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => str_repeat('1', 21), // 21 characters, max is 20
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone']);

        // Test phone not string
        $userData = [
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => 123456789,
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone']);
    }

    public function test_phone_uniqueness_validation()
    {
        // Create first user with phone
        User::create([
            'name' => 'First User',
            'email' => 'first@example.com',
            'password' => 'password123',
            'user_type' => 'user',
            'phone' => '+995 555 123 456',
        ]);

        // Try to create second user with same phone
        $userData = [
            'name' => 'Second User',
            'email' => 'second@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+995 555 123 456',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone'])
            ->assertJson([
                'errors' => [
                    'phone' => ['The phone has already been taken.']
                ]
            ]);
    }

    public function test_phone_field_in_user_model()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
            'phone' => '+995 555 123 456',
        ]);

        $this->assertEquals('+995 555 123 456', $user->phone);
        $this->assertTrue($user->phone !== null);
    }

    public function test_phone_field_is_fillable()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
            'phone' => '+995 555 123 456',
        ];

        $user = User::create($userData);

        $this->assertEquals('+995 555 123 456', $user->phone);
    }

    public function test_phone_field_accepts_various_formats()
    {
        $phoneNumbers = [
            '+995 555 123 456',
            '555123456',
            '+1-555-123-4567',
            '(555) 123-4567',
            '555.123.4567',
        ];

        foreach ($phoneNumbers as $index => $phone) {
            $userData = [
                'name' => "Test User {$index}",
                'email' => "test{$index}@example.com",
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'phone' => $phone,
            ];

            $response = $this->postJson('/api/register', $userData);

            $response->assertStatus(201)
                ->assertJson([
                    'data' => [
                        'user' => [
                            'phone' => $phone,
                        ]
                    ]
                ]);
        }
    }
}