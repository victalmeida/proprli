<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class TaskComment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_comment';

    /**
     * Updated Task Tag to identify Audit Process
     * @var string
     */
    const UPDATED_TASK_COMMENT_AUDIT = 'task_comment_update';

    /**
     * Created Task Tag to identify Audit Process
     * @var string
     */
    const CREATED_TASK_COMMENT_AUDIT = 'task_comment_create';


    /**
     * Process ID to Track all logs of the same process
     *
     * @var string|null
     */
    protected $processId = null;

     /**
     * Log changes information of updated Task on audit 
     * 
     * @return void
     */
    public function updatedAuditLog(): void
    {
        $audit = new Audit();
        $audit->audit_description = $this->toJson();
        $audit->audit_tag = self::UPDATED_TASK_COMMENT_AUDIT;
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
        $audit->audit_tag = self::CREATED_TASK_COMMENT_AUDIT;
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

    public function task(){
        return $this->belongsTo(Task::class, 'id', 'id');
    }

}
