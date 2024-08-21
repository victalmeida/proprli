<?php

namespace App\DTO;

use App\Http\Requests\IndexTaskRequest;

class IndexTaskDTO
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
        public string|null $task_creation_start,
        public string|null $task_creation_end,
        public int|null $assigned_user,
        public int|null $task_status
    ) {
    }

    /**
     * Type of filter for index task request
     *
     * @param IndexTaskRequest $request
     * 
     * @return IndexTaskDTO
     */
    public static function makeFromRequest(IndexTaskRequest $request): self
    {
        return new self(
            $request->task_creation_start,
            $request->task_creation_end,
            $request->assigned_user,
            $request->task_status
        );
    }
}
