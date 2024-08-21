<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Building;

class BuildingSeeder extends Seeder
{   
    const BUILDING_NAME = ['Building Team 1', 'Building Team 2'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::BUILDING_NAME as $building) {

            if (!Building::where('name', $building)
                ->get()
                ->isEmpty()) {
                continue;
            }
            Building::create(
                [
                    'name' => $building,
                ],
            );
        }
    }
}
