<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand names with their logo image URLs
        // You can replace these with your actual logo URLs or upload logos to storage
        $brands = [
            'Honda' => 'https://logos-world.net/wp-content/uploads/2020/04/Honda-Logo.png',
            'Yamaha' => 'https://logos-world.net/wp-content/uploads/2020/04/Yamaha-Logo.png',
            'Polaris' => 'https://logos-world.net/wp-content/uploads/2021/03/Polaris-Logo.png',
            'Can-Am' => 'https://logos-world.net/wp-content/uploads/2021/08/Can-Am-Logo.png',
            'Kawasaki' => 'https://logos-world.net/wp-content/uploads/2020/04/Kawasaki-Logo.png',
            'Suzuki' => 'https://logos-world.net/wp-content/uploads/2020/04/Suzuki-Logo.png',
            'Arctic Cat' => null,
            'CFMoto' => null,
            'Kymco' => null,
            'Linhai' => null,
            'Hisun' => null,
            'Massimo' => null,
            'TaoTao' => null,
            'Bennche' => null,
            'Coleman' => null,
            'Coyote' => null,
            'DRR' => null,
            'E-Ton' => null,
            'Gio' => null,
            'Himoto' => null,
            'Ice Bear' => null,
            'Kandi' => null,
            'Kazuma' => null,
            'Lifan' => null,
            'Loncin' => null,
            'Muddy' => null,
            'Pitster Pro' => null,
            'Roketa' => null,
            'SunL' => null,
            'Titan' => null,
            'TrailMaster' => null,
            'Viper' => null,
            'Wildcat' => null,
            'X-Pro' => null,
            'Zongshen' => null,
        ];

        foreach ($brands as $brandName => $imageUrl) {
            Brand::updateOrCreate(
                ['title' => $brandName],
                ['image' => $imageUrl]
            );
        }
    }
}