<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Georgian cities
        $georgianCities = [
            ['name' => 'Tbilisi', 'country' => 'Georgia', 'region' => 'Tbilisi', 'type' => 'city', 'is_georgian' => true, 'latitude' => 41.7151, 'longitude' => 44.8271],
            ['name' => 'Batumi', 'country' => 'Georgia', 'region' => 'Adjara', 'type' => 'city', 'is_georgian' => true, 'latitude' => 41.6168, 'longitude' => 41.6367],
            ['name' => 'Kutaisi', 'country' => 'Georgia', 'region' => 'Imereti', 'type' => 'city', 'is_georgian' => true, 'latitude' => 42.2488, 'longitude' => 42.7000],
            ['name' => 'Rustavi', 'country' => 'Georgia', 'region' => 'Kvemo Kartli', 'type' => 'city', 'is_georgian' => true, 'latitude' => 41.5475, 'longitude' => 45.0111],
            ['name' => 'Gori', 'country' => 'Georgia', 'region' => 'Shida Kartli', 'type' => 'city', 'is_georgian' => true, 'latitude' => 41.9842, 'longitude' => 44.1158],
            ['name' => 'Zugdidi', 'country' => 'Georgia', 'region' => 'Samegrelo-Zemo Svaneti', 'type' => 'city', 'is_georgian' => true, 'latitude' => 42.5083, 'longitude' => 41.8708],
            ['name' => 'Poti', 'country' => 'Georgia', 'region' => 'Samegrelo-Zemo Svaneti', 'type' => 'city', 'is_georgian' => true, 'latitude' => 42.1500, 'longitude' => 41.6667],
            ['name' => 'Khashuri', 'country' => 'Georgia', 'region' => 'Shida Kartli', 'type' => 'city', 'is_georgian' => true, 'latitude' => 41.9942, 'longitude' => 43.5908],
            ['name' => 'Samtredia', 'country' => 'Georgia', 'region' => 'Imereti', 'type' => 'city', 'is_georgian' => true, 'latitude' => 42.1617, 'longitude' => 42.3358],
            ['name' => 'Senaki', 'country' => 'Georgia', 'region' => 'Samegrelo-Zemo Svaneti', 'type' => 'city', 'is_georgian' => true, 'latitude' => 42.2700, 'longitude' => 42.0681],
        ];

        // International cities
        $internationalCities = [
            ['name' => 'New York', 'country' => 'United States', 'region' => 'New York', 'type' => 'city', 'is_georgian' => false, 'latitude' => 40.7128, 'longitude' => -74.0060],
            ['name' => 'London', 'country' => 'United Kingdom', 'region' => 'England', 'type' => 'city', 'is_georgian' => false, 'latitude' => 51.5074, 'longitude' => -0.1278],
            ['name' => 'Paris', 'country' => 'France', 'region' => 'Île-de-France', 'type' => 'city', 'is_georgian' => false, 'latitude' => 48.8566, 'longitude' => 2.3522],
            ['name' => 'Berlin', 'country' => 'Germany', 'region' => 'Berlin', 'type' => 'city', 'is_georgian' => false, 'latitude' => 52.5200, 'longitude' => 13.4050],
            ['name' => 'Moscow', 'country' => 'Russia', 'region' => 'Moscow', 'type' => 'city', 'is_georgian' => false, 'latitude' => 55.7558, 'longitude' => 37.6176],
            ['name' => 'Istanbul', 'country' => 'Turkey', 'region' => 'Istanbul', 'type' => 'city', 'is_georgian' => false, 'latitude' => 41.0082, 'longitude' => 28.9784],
            ['name' => 'Dubai', 'country' => 'United Arab Emirates', 'region' => 'Dubai', 'type' => 'city', 'is_georgian' => false, 'latitude' => 25.2048, 'longitude' => 55.2708],
            ['name' => 'Tokyo', 'country' => 'Japan', 'region' => 'Tokyo', 'type' => 'city', 'is_georgian' => false, 'latitude' => 35.6762, 'longitude' => 139.6503],
            ['name' => 'Sydney', 'country' => 'Australia', 'region' => 'New South Wales', 'type' => 'city', 'is_georgian' => false, 'latitude' => -33.8688, 'longitude' => 151.2093],
            ['name' => 'Toronto', 'country' => 'Canada', 'region' => 'Ontario', 'type' => 'city', 'is_georgian' => false, 'latitude' => 43.6532, 'longitude' => -79.3832],
        ];

        // Countries
        $countries = [
            ['name' => 'Georgia', 'country' => 'Georgia', 'region' => null, 'type' => 'country', 'is_georgian' => true, 'latitude' => 42.3154, 'longitude' => 43.3569],
            ['name' => 'United States', 'country' => 'United States', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 39.8283, 'longitude' => -98.5795],
            ['name' => 'United Kingdom', 'country' => 'United Kingdom', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 55.3781, 'longitude' => -3.4360],
            ['name' => 'France', 'country' => 'France', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 46.2276, 'longitude' => 2.2137],
            ['name' => 'Germany', 'country' => 'Germany', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 51.1657, 'longitude' => 10.4515],
            ['name' => 'Russia', 'country' => 'Russia', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 61.5240, 'longitude' => 105.3188],
            ['name' => 'Turkey', 'country' => 'Turkey', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 38.9637, 'longitude' => 35.2433],
            ['name' => 'United Arab Emirates', 'country' => 'United Arab Emirates', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 23.4241, 'longitude' => 53.8478],
            ['name' => 'Japan', 'country' => 'Japan', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 36.2048, 'longitude' => 138.2529],
            ['name' => 'Australia', 'country' => 'Australia', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => -25.2744, 'longitude' => 133.7751],
            ['name' => 'Canada', 'country' => 'Canada', 'region' => null, 'type' => 'country', 'is_georgian' => false, 'latitude' => 56.1304, 'longitude' => -106.3468],
        ];

        // Insert all locations
        Location::insert(array_merge($georgianCities, $internationalCities, $countries));
    }
}