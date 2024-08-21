<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Team;

class TeamSeeder extends Seeder
{
    const TEAMS = ['Team 1', 'Team 2'];
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        foreach (self::TEAMS as $team) {

            if (!Team::where('name', $team)
                ->get()
                ->isEmpty()) {
                continue;
            }
            Team::create(
                [
                    'name' => $team,
                ],
            );
        }
    }
}
