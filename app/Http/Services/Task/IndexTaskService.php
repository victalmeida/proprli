<?php

namespace App\Http\Services\Task;

use Illuminate\Database\Eloquent\Collection;
use App\DTO\IndexTaskDTO;
use App\Models\Fluents\TaskFluent;

class IndexTaskService
{
    /**
     * Update the task aplyng the rules
     *
     * @param IndexTaskDTO $indexTaskDTO
     * 
     * @return Collection<int, Task>
     */
    public function execute(IndexTaskDTO $indexTaskDTO): Collection
    {
        $result = TaskFluent::with('taskComment')
            ->assignedUserFilter((int) $indexTaskDTO->assigned_user)
            ->taskStatusFilter((int) $indexTaskDTO->task_status)
            ->createdAtFilter(
                (string) $indexTaskDTO->task_creation_start,
                (string)$indexTaskDTO->task_creation_end
            )
            ->get();

        return $result;
    }
}
