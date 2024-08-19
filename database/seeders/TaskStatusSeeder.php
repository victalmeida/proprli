<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{

    const statusName = ['Open', 'In Progress', 'Completed', 'Rejected'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::statusName as $statusName) {
            if (TaskStatus::where('status_name', $statusName)) {
                continue;
            }
            TaskStatus::create(
                [
                    'status_name' => $statusName,
                ],
            );
        }
    }
}
