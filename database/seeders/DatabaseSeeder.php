<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'phone' => '09251356521',
            'password' => '123456789',
            'is_admin'=> '1',
        ]);
        $this->call(CategorySeeder::class);
       // $this->call(productSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(UserSeeder::class);
    }
}
