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
        $brands = [
            'Honda',
            'Yamaha',
            'Polaris',
            'Can-Am',
            'Kawasaki',
            'Suzuki',
            'Arctic Cat',
            'CFMoto',
            'Kymco',
            'Linhai',
            'Hisun',
            'Massimo',
            'TaoTao',
            'Bennche',
            'Coleman',
            'Coyote',
            'DRR',
            'E-Ton',
            'Gio',
            'Himoto',
            'Ice Bear',
            'Kandi',
            'Kazuma',
            'Lifan',
            'Loncin',
            'Muddy',
            'Pitster Pro',
            'Roketa',
            'SunL',
            'Titan',
            'TrailMaster',
            'Viper',
            'Wildcat',
            'X-Pro',
            'Zongshen',
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'title' => $brand,
            ]);
        }
    }
}