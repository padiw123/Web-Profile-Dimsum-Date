<?php

namespace Database\Seeders;

use create;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true
        ]);

        Admin::create([
            'name' => 'Admin Dimsum',
            'email' => 'admin@dimsum.test',
            'password' => bcrypt('password'), // ganti jika ingin password lebih kuat
        ]);

        Promo::create([
            'title' => 'Weekend All-You-Can-Eat',
            'description' => 'Unlimited dimsum every weekend.',
            'price' => 3999,
            'price_note' => 'per person',
            'features' => json_encode([
                'Unlimited Dimsum',
                'Free Flow Chinese Tea',
                'Dessert Buffet'
            ]),
            'cta_link' => '#contact'
        ]);

        Promo::create([
            'title' => 'Family Feast',
            'description' => 'Great for 4 people.',
            'price' => 8999,
            'price_note' => 'for 4 people',
            'features' => json_encode([
                '20 pieces Signature Dimsum',
                '4 Special Soups',
                '4 Desserts'
            ]),
            'cta_link' => '#contact'
        ]);

        $this->call(MenuSeeder::class);

    }
}
