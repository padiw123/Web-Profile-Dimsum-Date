<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::insert([
            [
                'name' => 'Har Gow',
                'category' => 'steamed',
                'price' => 6.50,
                'description' => 'Crystal shrimp dumplings with bamboo shoots',
                'image_url' => 'https://images.pexels.com/photos/955137/pexels-photo-955137.jpeg?...',
            ],
            [
                'name' => 'Siu Mai',
                'category' => 'steamed',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://images.pexels.com/photos/2664443/pexels-photo-2664443.jpeg?...',
            ],
            [
                'name' => 'Spring Rolls',
                'category' => 'fried',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://images.pexels.com/photos/15913452/pexels-photo-15913452/free-photo-of-spring-rolls-on-plate.jpeg?...',
            ],
            [
                'name' => 'Fried Wontons',
                'category' => 'fried',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://redhousespice.com/wp-content/uploads/2024/01/deep-fried-wontons-0.jpg...',
            ],
            [
                'name' => 'Char Siu Bao',
                'category' => 'buns',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://images.pexels.com/photos/9470516/pexels-photo-9470516.jpeg?...',
            ],
            [
                'name' => 'Lotus Seed Bun ',
                'category' => 'buns',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://images.pexels.com/photos/674574/pexels-photo-674574.jpeg?...',
            ],
            [
                'name' => 'Egg Tarts',
                'category' => 'steamed',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => 'https://images.pexels.com/photos/2313682/pexels-photo-2313682.jpeg?...',
            ],
            // Tambah data lain sesuai kebutuhan
        ]);
    }
}

