<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration_defaults_to_user_type()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
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
                        'name' => 'John Doe',
                        'email' => 'john@example.com',
                        'user_type' => 'user',
                    ]
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'user_type' => 'user',
        ]);
    }

    public function test_user_type_cannot_be_set_during_registration()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'user_type' => 'admin', // This should be rejected
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_type']);
    }

    public function test_user_model_helper_methods()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $this->assertTrue($user->isUser());
        $this->assertFalse($user->isAdmin());

        // Test admin user by directly setting the attribute (bypassing mass assignment)
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = 'password123';
        $admin->user_type = 'admin';
        $admin->save();

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isUser());
    }

    public function test_admin_cannot_be_created_via_mass_assignment()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Admin users cannot be created via API endpoints');

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'user_type' => 'admin',
        ]);
    }
}