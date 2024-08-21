<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{

    /**
     * Handle the Task "creating" event.
     */
    public function creating(Task $task): void {}


    /**
     * Handle the Task "updating" event.
     */
    public function updating(Task $task): void
    {
        $task->checkTaskStatus();
    }

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void {
       
        $task->createdAuditLog();
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $task->updatedAuditLog();
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
