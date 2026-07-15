<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(HowWeWorkSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(AboutPageSeeder::class);
        $this->call(ContactPageSeeder::class);
    }
}
