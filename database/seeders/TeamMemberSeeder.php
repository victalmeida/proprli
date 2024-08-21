<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    const TEAM_MEMBERS = [
        1 => [1, 2],
        2 => [3, 4]
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::TEAM_MEMBERS as $team => $members) {

            foreach ($members as $member) {
                if (!TeamMember::where([
                    ['team_id', $team],
                    ['member_id',  $member]
                ])
                    ->get()
                    ->isEmpty()) {
                    continue;
                }
                TeamMember::create(
                    [
                        'team_id' => $team,
                        'member_id' => $member
                    ],
                );
            }          
        }
    }
}
