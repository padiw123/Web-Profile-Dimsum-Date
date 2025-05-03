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
                'image_url' => '',
            ],
            [
                'name' => 'Siu Mai',
                'category' => 'steamed',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            [
                'name' => 'Spring Rolls',
                'category' => 'fried',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            [
                'name' => 'Fried Wontons',
                'category' => 'fried',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            [
                'name' => 'Char Siu Bao',
                'category' => 'buns',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            [
                'name' => 'Lotus Seed Bun ',
                'category' => 'buns',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            [
                'name' => 'Egg Tarts',
                'category' => 'steamed',
                'price' => 5.95,
                'description' => 'Open-faced dumplings with pork, shrimp and mushroom',
                'image_url' => '',
            ],
            // Tambah data lain sesuai kebutuhan
        ]);
    }
}

