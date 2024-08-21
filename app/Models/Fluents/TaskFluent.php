<?php

namespace App\Models\Fluents;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Task;

class TaskFluent extends Task
{


    /**
     * fluent to filter by assigned user
     *
     * @param integer $assigneUser
     * @return Builder
     */
    public function scopeAssignedUserFilter(
        Builder $builder,
        int|null $assigneUser
    ): Builder {
        if (empty($assigneUser)) {
            return $builder;
        }
        return $builder->where("assigned_user", $assigneUser);
    }

    /**
     * Fluent to filter by task_status
     *
     * @param integer $taskStatus
     * @return Builder
     */
    public function scopeTaskStatusFilter(
        Builder $builder,
        int $taskStatus
    ): Builder {
        if (empty($taskStatus)) {
            return $builder;
        }
        return $builder->where("task_status", $taskStatus);
    }

    /**
     * Fluent to filter by created_at_field case just $startDate informed then filter by the day 
     * else filter by period
     *
     * @param string $startDate
     * @param string $endDate
     * @return Builder
     */
    public function scopeCreatedAtFilter(
        Builder $builder,
        string $startDate = '',
        string $endDate = ''
    ): Builder {

        if (
            empty($taskStatus)
            && empty($startDate)
        ) {
            return $builder;
        }

        if (!empty($endDate)) {
            return $builder->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        return $builder->whereDate('created_at', $startDate);
    }
}
