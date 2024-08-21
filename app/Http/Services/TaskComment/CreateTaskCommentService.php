<?php

namespace App\Http\Services\TaskComment;

use Illuminate\Support\Str;

use App\Models\Task;
use App\Models\TaskComment;
use App\DTO\CreateTaskCommentDTO;
use App\Exceptions\AppException;

class CreateTaskCommentService
{
    /**
     * Service to create a new task comment
     *
     * @param CreateTaskCommentDTO $createTaskCommentDTO
     * 
     * @throws AppException case Task id not valid
     * @return TaskComment
     */
    public function execute($createTaskCommentDTO): TaskComment
    {
        if (empty(Task::find($createTaskCommentDTO->task_id))) {
            throw new AppException('Task informed not exist.', 401);
        }

        $newTaskComment = new TaskComment();
        $processId = Str::uuid()->toString();
        $newTaskComment->setProcessId($processId);

        $newTaskComment->comment = $createTaskCommentDTO->comment;
        $newTaskComment->user_id = auth()->user()->id;
        $newTaskComment->task_id = $createTaskCommentDTO->task_id;

        $newTaskComment->save();
        return $newTaskComment;
    }
}
