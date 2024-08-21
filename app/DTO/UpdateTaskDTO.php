<?php

namespace App\DTO;

use App\Http\Requests\UpdateTaskRequest;

class UpdateTaskDTO
{
    /**
     * Atributes to Update a Task
     *
     * @param integer $task_id ID of task
     * @param string|null $task_name Name of Task
     * @param string|null $task_description Description of task
     * @param integer|null $assigned_user ID of user to assing to task
     * @param integer|null $task_status ID of building to assign to task
     */
    public function __construct(
        public int $task_id,
        public string|null $task_name,
        public string|null $task_description,
        public int|null $assigned_user,
        public int|null $task_status,
    ) {}

    /**
     * Create a new UpdateTaskDTO for request
     *
     * @param UpdateTaskRequest $request
     * 
     * @return UpdateTaskDTO
     */
    public static function makeFromRequest(UpdateTaskRequest $request): self
    {
        return new self(
            $request->task_id,
            $request->task_name,
            $request->task_description,
            $request->assigned_user,
            $request->task_status
        );
    }
}
