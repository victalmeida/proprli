<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $assignedTeam = rand(1,2);
        $assignedUser = $assignedTeam == 1 ? rand(1,2) : rand(3,4);

        return [
            "task_name" => $this->faker->name(),
            "task_description" => $this->faker->paragraph(),
            "assigned_user" => $assignedUser,
            "assigned_team" => $assignedTeam,
            "assigned_building" => rand(1,2),
            "task_status" => TaskStatus::OPEN
        ];
    }
}
