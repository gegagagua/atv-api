<?php

namespace Database\Seeders;

use App\Models\Atv;
use App\Models\AtvImage;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AtvDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $users = $this->createUsers();
        
        // Create sample locations
        $locations = $this->createLocations();
        
        // Create 20 ATVs with full data
        $this->createAtvs($users, $locations);
    }

    private function createUsers(): array
    {
        $users = [];
        
        $userData = [
            ['name' => 'გიორგი ბერიძე', 'email' => 'giorgi@example.com', 'phone' => '+995 555 111 111'],
            ['name' => 'ნინო კვარაცხელია', 'email' => 'nino@example.com', 'phone' => '+995 555 222 222'],
            ['name' => 'ლევან ჯაფარიძე', 'email' => 'levan@example.com', 'phone' => '+995 555 333 333'],
            ['name' => 'თამარ ლომიძე', 'email' => 'tamar@example.com', 'phone' => '+995 555 444 444'],
            ['name' => 'დავით ხარაბაძე', 'email' => 'davit@example.com', 'phone' => '+995 555 555 555'],
            ['name' => 'ანა ნათელაშვილი', 'email' => 'ana@example.com', 'phone' => '+995 555 666 666'],
            ['name' => 'ირაკლი ზაქარია', 'email' => 'irakli@example.com', 'phone' => '+995 555 777 777'],
            ['name' => 'მარიამ ბურჯანაძე', 'email' => 'mariam@example.com', 'phone' => '+995 555 888 888'],
            ['name' => 'ნიკა ტოროშელიძე', 'email' => 'nika@example.com', 'phone' => '+995 555 999 999'],
            ['name' => 'სალომე ჩაჩუა', 'email' => 'salome@example.com', 'phone' => '+995 555 000 000'],
        ];

        foreach ($userData as $data) {
            $users[] = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'phone' => $data['phone'],
                'user_type' => 'user',
            ]);
        }

        return $users;
    }

    private function createLocations(): array
    {
        $locations = [];
        
        $locationData = [
            ['name' => 'თბილისი', 'country' => 'საქართველო', 'region' => 'თბილისი'],
            ['name' => 'ბათუმი', 'country' => 'საქართველო', 'region' => 'აჭარა'],
            ['name' => 'ქუთაისი', 'country' => 'საქართველო', 'region' => 'იმერეთი'],
            ['name' => 'რუსთავი', 'country' => 'საქართველო', 'region' => 'ქვემო ქართლი'],
            ['name' => 'გორი', 'country' => 'საქართველო', 'region' => 'შიდა ქართლი'],
            ['name' => 'ზუგდიდი', 'country' => 'საქართველო', 'region' => 'სამეგრელო-ზემო სვანეთი'],
            ['name' => 'ფოთი', 'country' => 'საქართველო', 'region' => 'სამეგრელო-ზემო სვანეთი'],
            ['name' => 'ცხინვალი', 'country' => 'საქართველო', 'region' => 'შიდა ქართლი'],
            ['name' => 'ახალციხე', 'country' => 'საქართველო', 'region' => 'სამცხე-ჯავახეთი'],
            ['name' => 'თელავი', 'country' => 'საქართველო', 'region' => 'კახეთი'],
        ];

        foreach ($locationData as $data) {
            $locations[] = Location::create($data);
        }

        return $locations;
    }

    private function createAtvs(array $users, array $locations): void
    {
        $atvData = [
            [
                'name' => 'Honda FourTrax 300',
                'price' => 8500.00,
                'year' => 2023,
                'clearance' => '8.5 inches',
                'mileage' => 1500,
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => '286cc Single Cylinder',
                'description' => 'შესანიშნავი მდგომარეობის ATV, დაბალი გარბენით. იდეალურია ტურიზმისთვის და ყოველდღიური გამოყენებისთვის.',
                'isActive' => true,
                'isVip' => true,
            ],
            [
                'name' => 'Yamaha Grizzly 700',
                'price' => 12000.00,
                'year' => 2022,
                'clearance' => '10.2 inches',
                'mileage' => 3200,
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => '686cc Single Cylinder',
                'description' => 'ძლიერი და საიმედო ATV, შესანიშნავია მთიანი ტერიტორიებისთვის. ყველა საჭირო აქსესუარით.',
                'isActive' => true,
                'isVip' => false,
            ],
            [
                'name' => 'Polaris Sportsman 450',
                'price' => 9500.00,
                'year' => 2023,
                'clearance' => '9.5 inches',
                'mileage' => 800,
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => '455cc Single Cylinder',
                'description' => 'ახალი მოდელი, ყველა თანამედროვე ტექნოლოგიით. კომფორტული და ეკონომიური.',
                'isActive' => true,
                'isVip' => true,
            ],
            [
                'name' => 'Can-Am Outlander 650',
                'price' => 11000.00,
                'year' => 2021,
                'clearance' => '11.0 inches',
                'mileage' => 4500,
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => '650cc V-Twin',
                'description' => 'ძლიერი V-Twin ძრავით, შესანიშნავია რთული ტერიტორიებისთვის. ყველა საჭირო ფუნქციით.',
                'isActive' => true,
                'isVip' => false,
            ],
            [
                'name' => 'Kawasaki Brute Force 750',
                'price' => 10500.00,
                'year' => 2022,
                'clearance' => '9.8 inches',
                'mileage' => 2100,
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => '749cc V-Twin',
                'description' => 'სპორტული დიზაინი და ძლიერი ძრავი. იდეალურია ადრენალინის მოყვარულებისთვის.',
                'isActive' => true,
                'isVip' => true,
            ],
        ];

        // Add more ATVs to reach 20
        for ($i = 5; $i < 20; $i++) {
            $atvData[] = [
                'name' => "ATV Model {$i}",
                'price' => rand(6000, 15000),
                'year' => rand(2020, 2023),
                'clearance' => rand(7, 12) . ' inches',
                'mileage' => rand(500, 5000),
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'engine' => rand(300, 1000) . 'cc Engine',
                'description' => 'შესანიშნავი მდგომარეობის ATV, იდეალურია ყველა საჭიროებისთვის.',
                'isActive' => true,
                'isVip' => rand(0, 1) == 1,
            ];
        }

        foreach ($atvData as $index => $data) {
            $atv = Atv::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'year' => $data['year'],
                'clearance' => $data['clearance'],
                'mileage' => $data['mileage'],
                'transmission' => $data['transmission'],
                'fuel' => $data['fuel'],
                'engine' => $data['engine'],
                'description' => $data['description'],
                'isActive' => $data['isActive'],
                'isVip' => $data['isVip'],
                'user_id' => $users[$index % count($users)]->id,
                'location_id' => $locations[$index % count($locations)]->id,
            ]);

            // Add images to each ATV
            $this->addImagesToAtv($atv, $index);
        }
    }

    private function addImagesToAtv(Atv $atv, int $index): void
    {
        $imageUrls = [
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1594736797933-d0c29d4b8b0a?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1612198188060-c7c2a3b66e05?w=800&h=600&fit=crop',
        ];

        // Add 3-5 images per ATV
        $imageCount = rand(3, 5);
        for ($i = 0; $i < $imageCount; $i++) {
            AtvImage::create([
                'atv_id' => $atv->id,
                'url' => $imageUrls[$i % count($imageUrls)],
                'type' => 'image',
                'alt_text' => "{$atv->name} - სურათი " . ($i + 1),
                'sort_order' => $i + 1,
                'is_primary' => $i === 0, // First image is primary
                'is_active' => true,
            ]);
        }
    }
}