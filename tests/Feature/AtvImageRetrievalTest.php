<?php

namespace Tests\Feature;

use App\Models\Atv;
use App\Models\AtvImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AtvImageRetrievalTest extends TestCase
{
    use RefreshDatabase;

    public function test_atv_list_includes_images()
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
            'user_id' => $user->id,
        ]);

        // Add some images to the ATV
        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image2.jpg',
            'type' => 'image',
            'alt_text' => 'ATV side view',
            'sort_order' => 2,
            'is_primary' => false,
            'is_active' => true,
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
                            'active_images' => [
                                '*' => [
                                    'id',
                                    'url',
                                    'type',
                                    'alt_text',
                                    'sort_order',
                                    'is_primary',
                                    'is_active',
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function test_atv_show_includes_images()
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
            'user_id' => $user->id,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        $response = $this->getJson("/api/atvs/{$atv->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'active_images' => [
                        '*' => [
                            'id',
                            'url',
                            'type',
                            'alt_text',
                            'sort_order',
                            'is_primary',
                            'is_active',
                        ]
                    ]
                ]
            ]);
    }

    public function test_get_atv_images_endpoint()
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
            'user_id' => $user->id,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/video1.mp4',
            'type' => 'video',
            'alt_text' => 'ATV video',
            'sort_order' => 2,
            'is_primary' => false,
            'is_active' => true,
        ]);

        $response = $this->getJson("/api/atvs/{$atv->id}/images");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'url',
                        'type',
                        'alt_text',
                        'sort_order',
                        'is_primary',
                        'is_active',
                    ]
                ]
            ]);

        // Test filtering by type
        $response = $this->getJson("/api/atvs/{$atv->id}/images?type=image");

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertEquals('image', $data[0]['type']);

        // Test filtering by active_only
        $response = $this->getJson("/api/atvs/{$atv->id}/images?active_only=true");

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertCount(2, $data);
    }

    public function test_get_atv_gallery_endpoint()
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
            'user_id' => $user->id,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        $response = $this->getJson("/api/atvs/{$atv->id}/gallery");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'url',
                        'type',
                        'alt_text',
                        'sort_order',
                        'is_primary',
                        'is_active',
                        'created_at',
                    ]
                ]
            ]);
    }

    public function test_get_atv_primary_image_endpoint()
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
            'user_id' => $user->id,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        $response = $this->getJson("/api/atvs/{$atv->id}/primary-image");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'url',
                    'type',
                    'alt_text',
                    'sort_order',
                    'is_primary',
                    'is_active',
                ]
            ])
            ->assertJson([
                'data' => [
                    'is_primary' => true,
                    'url' => 'https://example.com/image1.jpg',
                ]
            ]);
    }

    public function test_get_atv_primary_image_not_found()
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
            'user_id' => $user->id,
        ]);

        $response = $this->getJson("/api/atvs/{$atv->id}/primary-image");

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Primary image not found',
            ]);
    }

    public function test_atv_model_image_methods()
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
            'user_id' => $user->id,
        ]);

        // Add images
        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/image1.jpg',
            'type' => 'image',
            'alt_text' => 'ATV front view',
            'sort_order' => 1,
            'is_primary' => true,
            'is_active' => true,
        ]);

        AtvImage::create([
            'atv_id' => $atv->id,
            'url' => 'https://example.com/video1.mp4',
            'type' => 'video',
            'alt_text' => 'ATV video',
            'sort_order' => 2,
            'is_primary' => false,
            'is_active' => true,
        ]);

        // Test model methods
        $this->assertEquals(2, $atv->images()->count());
        $this->assertEquals(1, $atv->imageFiles()->count());
        $this->assertEquals(1, $atv->videoFiles()->count());
        $this->assertEquals(2, $atv->activeImages()->count());
        $this->assertEquals(1, $atv->activeImageFiles()->count());

        // Test accessor methods
        $this->assertEquals('https://example.com/image1.jpg', $atv->first_image_url);
        $this->assertContains('https://example.com/image1.jpg', $atv->image_urls);
        $this->assertCount(1, $atv->image_urls);

        // Test gallery accessor
        $gallery = $atv->gallery;
        $this->assertIsArray($gallery);
        $this->assertCount(2, $gallery);
        $this->assertArrayHasKey('url', $gallery[0]);
        $this->assertArrayHasKey('type', $gallery[0]);
    }
}