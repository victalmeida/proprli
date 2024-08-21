<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BuildingSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\TeamMemberSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TaskStatusSeeder::class,
            UserSeeder::class,
            BuildingSeeder::class,
            TeamSeeder::class,
            TeamMemberSeeder::class,
        ]);
    }
}
