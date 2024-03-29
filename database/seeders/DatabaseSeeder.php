<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::insert([
            ['type' => 'Vehicle'],
            ['type' => 'Furniture'],
            ['type' => 'Animal'],
            ['type' => 'Electronics'],
            ['type' => 'Home accessories'],
            ['type' => 'Other']
        ]);


//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
