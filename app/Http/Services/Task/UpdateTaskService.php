<?php

namespace App\Http\Services\Task;

use Illuminate\Support\Str;
use App\Exceptions\AppException;
use App\DTO\UpdateTaskDTO;
use App\Models\TeamMember;
use App\Models\Task;

class UpdateTaskService
{
    /**
     * Update the task aplyng the rules
     *
     * @param UpdateTaskDTO $updateTaskDTO
     * 
     * @throws AppException If Task not exist
     * 
     * @return Task
     */
    public function execute(UpdateTaskDTO $updateTaskDTO): Task
    {
        $updateTask = Task::find($updateTaskDTO->task_id);

        if (!$updateTask) {
            throw new AppException(
                'Task not found.',
                401
            );
        }

        if ($updateTaskDTO->assigned_user) {
            $this->userIsTeamMember(
                $updateTask->assigned_team,
                $updateTaskDTO->assigned_user
            );
        }

        $processId = Str::uuid()->toString();
        $updateTask->setProcessId($processId);

        $updateTask->task_name = $updateTaskDTO->task_name ?? $updateTask->task_name;
        $updateTask->task_description = $updateTaskDTO->task_description ?? $updateTask->task_description;
        $updateTask->assigned_user = $updateTaskDTO->assigned_user ?? $updateTask->assigned_user;
        $updateTask->task_status = $updateTaskDTO->task_status ?? $updateTask->task_status;

        $updateTask->save();

        return $updateTask;
    }

    /**
     * Check if informed user bellow to task team
     *
     * @param integer $team
     * @param integer $member
     * 
     * @throws AppException If not a team member
     * @return void
     */
    public function userIsTeamMember(
        int $team,
        int $member
    ): void {

        $notInTeam = TeamMember::where(
            [
                ['member_id', $member],
                ['team_id', $team]
            ]
        )
            ->get()
            ->isEmpty();

        if ($notInTeam) {
            throw new AppException(
                'User assigned is not a team member.',
                401
            );
        }
    }
}
