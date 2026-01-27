<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SettingsSeeder::class,
            DemoCustomerSeeder::class,
            HomeSeeder::class,
            PageSeeder::class,
            ReviewSeeder::class,
            TestimonialSeeder::class,
            
        ]);
    }
}
