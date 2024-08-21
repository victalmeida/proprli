<?php

namespace App\DTO;

use App\Http\Requests\CreateTaskRequest;

class CreateTaskDTO
{
    /**
     * Atributes to Create a new Task
     *
     * @param string $task_name Name of Task
     * @param integer $assigned_building ID of building to assign to task
     * @param integer $assigned_team ID of Team to assign to task
     * @param string|null $task_description Description of task
     * @param integer|null $assigned_user ID of user to assing to task
     */
    public function __construct(
        public string $task_name,
        public int $assigned_building,
        public int $assigned_team,
        public string|null $task_description,
        public int|null $assigned_user,
    ) {}

    /**
     * Create a new CreateTaskDTO for request
     *
     * @param CreateTaskRequest $request
     * 
     * @return CreateTaskDTO
     */
    public static function makeFromRequest(CreateTaskRequest $request): self
    {
        return new self(
            $request->task_name,
            $request->assigned_building,
            $request->assigned_team,
            $request->task_description,
            $request->assigned_user
        );
    } 
    
    /**
     * Create a new CreateTaskDTO for array
     *
     * @param array data
     * 
     * @return CreateTaskDTO
     */
    public static function makeFromArray(array $data): self
    {
        return new self(
            $data["task_name"],
            $data["assigned_building"],
            $data["assigned_team"],
            $data["task_description"],
            $data["assigned_user"]
        );
    }
}
