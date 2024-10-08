<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{

    const STATUS_NAME = ['Open', 'In Progress', 'Completed', 'Rejected'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::STATUS_NAME as $statusName) {

            if (!TaskStatus::where('status_name', $statusName)
                ->get()
                ->isEmpty()) {
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
