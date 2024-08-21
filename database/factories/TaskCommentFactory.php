<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskComment>
 */
class TaskCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tasks = Task::all()->toArray();

        if (empty($tasks)) {
            return [];
        }

        $taskNumber = (rand(1, count($tasks)));
        $task = $tasks[--$taskNumber];

        return [
            "comment" => $this->faker->paragraph(),
            "user_id" => $task['assigned_user'] ,
            "task_id" => $task['id'] 
        ];
    }
}
