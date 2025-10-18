<?php

namespace Tests\Feature;

use App\Models\Atv;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AtvUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a brand for testing
        Brand::create(['title' => 'Test Brand']);
    }

    public function test_atv_creation_automatically_sets_user_id()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        Sanctum::actingAs($user);

        $atvData = [
            'name' => 'Test ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'description' => 'Test ATV description',
            'brand_id' => 1,
        ];

        $response = $this->postJson('/api/atvs', $atvData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'ATV created successfully',
                'data' => [
                    'name' => 'Test ATV',
                    'user_id' => $user->id,
                ]
            ]);

        $this->assertDatabaseHas('atvs', [
            'name' => 'Test ATV',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_id_cannot_be_set_manually()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        Sanctum::actingAs($user);

        $atvData = [
            'name' => 'Test ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'brand_id' => 1,
            'user_id' => 999, // This should be rejected
        ];

        $response = $this->postJson('/api/atvs', $atvData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id']);
    }

    public function test_user_can_only_update_own_atvs()
    {
        $user1 = User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        // Create ATV for user1
        $atv = Atv::create([
            'name' => 'User 1 ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'user_id' => $user1->id,
        ]);

        // Try to update as user2
        Sanctum::actingAs($user2);

        $updateData = [
            'name' => 'Updated ATV Name',
            'price' => 6000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'brand_id' => 1,
        ];

        $response = $this->putJson("/api/atvs/{$atv->id}", $updateData);

        $response->assertStatus(403)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthorized. You can only update your own ATVs.',
            ]);
    }

    public function test_admin_can_update_any_atv()
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        // Create admin user directly (bypassing mass assignment protection)
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = 'password123';
        $admin->user_type = 'admin';
        $admin->save();

        // Create ATV for regular user
        $atv = Atv::create([
            'name' => 'User ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'user_id' => $user->id,
        ]);

        // Update as admin
        Sanctum::actingAs($admin);

        $updateData = [
            'name' => 'Updated by Admin',
            'price' => 6000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'brand_id' => 1,
        ];

        $response = $this->putJson("/api/atvs/{$atv->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'ATV updated successfully',
                'data' => [
                    'name' => 'Updated by Admin',
                ]
            ]);
    }

    public function test_atv_relationships()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        $atv = Atv::create([
            'name' => 'Test ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'brand_id' => 1,
            'user_id' => $user->id,
        ]);

        // Test ATV belongs to user
        $this->assertEquals($user->id, $atv->user_id);
        $this->assertTrue($atv->user->is($user));

        // Test user has many ATVs
        $this->assertTrue($user->atvs->contains($atv));
        $this->assertEquals(1, $user->atvs->count());
    }

    public function test_atv_list_includes_user_data()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'user_type' => 'user',
        ]);

        Atv::create([
            'name' => 'Test ATV',
            'price' => 5000.00,
            'year' => 2023,
            'clearance' => '8.5 inches',
            'mileage' => 1000,
            'transmission' => 'Automatic',
            'fuel' => 'Gasoline',
            'engine' => '300cc',
            'brand_id' => 1,
            'user_id' => $user->id,
        ]);

        $response = $this->getJson('/api/atvs');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'price',
                            'year',
                            'user_id',
                            'user' => [
                                'id',
                                'name',
                                'email',
                                'user_type',
                            ],
                        ]
                    ]
                ]
            ]);
    }
}