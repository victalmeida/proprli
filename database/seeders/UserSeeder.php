<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{

    const USERS = [
        [
            "name" => "Lafayette Kirlin IV",
            "email" => "berniece.jones@example.net"
        ],
        [
            "name" => "Matilde Collier",
            "email" => "fprohaska@example.org"
        ],
        [
            "name" => "Shanna Gerlach",
            "email" => "arno.okeefe@example.net"
        ],
        [
            "name" => "Dr. Audreanne Klein",
            "email" => "swift.rodrigo@example.net"
        ],
        [
            "name" => "Ms. Yvonne Zulauf PhD",
            "email" => "hanna48@example.org"
        ],
        [
            "name" => "Reina Emmerich",
            "email" => "natalia.mcdermott@example.org"
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (self::USERS as $user) {

            if (!User::where('email', $user['email'])
                ->get()
                ->isEmpty()) {
                continue;
            }

            User::factory()->create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                ],
            );
        }
    }
}
