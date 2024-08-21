<?php

namespace App\DTO;

use App\Http\Requests\CreateTaskCommentRequest;

class CreateTaskCommentDTO
{
    /**
     * Atributes to Create a Task Comment
     *
     * @param integer $task_id ID of task
     * @param string|null $comment comment of task
     */
    public function __construct(
        public int $task_id,
        public string $comment,
    ) {}

    /**
     * Create a new UpdateTaskDTO for request
     *
     * @param CreateTaskCommentRequest $request
     * 
     * @return UpdateTaskDTO
     */
    public static function makeFromRequest(CreateTaskCommentRequest $request): self
    {
        return new self(
            $request->task_id,
            $request->comment,
        );
    }
}
