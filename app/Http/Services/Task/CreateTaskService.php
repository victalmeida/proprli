<?php

namespace App\Http\Services\Task;

use Illuminate\Support\Str;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TeamMember;
use App\Exceptions\AppException;
use App\DTO\CreateTaskDTO;

class CreateTaskService
{
    /**
     * Undocumented function
     *
     * @param [type] $requestData
     * @return Task
     */
    public function execute(CreateTaskDTO $createTaskDTO): Task
    {

        if ($createTaskDTO->assigned_user) {
            $this->userIsTeamMember(
                $createTaskDTO->assigned_team,
                $createTaskDTO->assigned_user
            );
        }

        $newTask = new Task();
        $processId = Str::uuid()->toString();
        $newTask->setProcessId($processId);

        $newTask->task_name = $createTaskDTO->task_name;
        $newTask->task_description = $createTaskDTO->task_description;
        $newTask->assigned_user = $createTaskDTO->assigned_user;
        $newTask->assigned_team = $createTaskDTO->assigned_team;
        $newTask->assigned_building = $createTaskDTO->assigned_building;
        $newTask->task_status = TaskStatus::OPEN;
        $newTask->save();

        return $newTask;
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
    protected function userIsTeamMember(
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
