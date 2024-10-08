<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TaskStatus;
use App\Models\TaskComment;


class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task';

    /**
     * Updated Task Tag to identify Audit Process
     * @var string
     */
    const UPDATED_AUDIT = 'task_update';

    /**
     * Created Task Tag to identify Audit Process
     * @var string
     */
    const CREATED_AUDIT = 'task_create';

    /**
     * Process ID to Track all logs of the same process
     *
     * @var string|null
     */
    protected $processId = null;


    /**
     * Business rule for check if Status is Allowed 
     *
     * @throws AppException Case informed status is not allowed
     * @return void
     */
    public function checkTaskStatus()
    {
        if (empty($this->task_status)) {
            return;
        }

        $taskStatusExist = TaskStatus::find($this->task_status);

        if (empty($taskStatusExist)) {
            throw new AppException('Task status not allowed', 401);
        }
    }

    /**
     * Log changes information of updated Task on audit 
     * 
     * @return void
     */
    public function updatedAuditLog(): void
    {
        $audit = new Audit();
        $audit->audit_description = $this->toJson();
        $audit->audit_tag = self::UPDATED_AUDIT;
        $audit->process_id = $this->processId;
        $audit->user = auth()->user()->id;
        $audit->save();
    }

    /**
     * Log information of a creation task on audit
     *
     * @return void
     */
    public function createdAuditLog(): void
    {
        $audit = new Audit();
        $audit->audit_description = $this->toJson();
        $audit->audit_tag = self::CREATED_AUDIT;
        $audit->process_id = $this->processId;
        $audit->user = auth()->user()->id;
        $audit->save();
    }

    /**
     * Setter for $this->processId
     *
     * @param string $processId
     * 
     * @return void
     */
    public function setProcessId(string $processId): void
    {
        $this->processId = $processId;
    }


    public function taskComment()
    {
        return $this->hasMany(TaskComment::class, 'task_id', 'id');
    }

}
