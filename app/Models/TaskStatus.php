<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    /**
     * Open Status ID
     * @var int
     */
    const OPEN = 1;

    /**
     * In Progress ID
     * 
     * @var int
     */
    const IN_PROGRESS = 2;

    /**
     * Completed ID
     * 
     * @var int
     */
    const COMPLETED = 3;

    /**
     * Rejected ID
     * 
     * @var int
     */
    const REJECTED =  4;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_status';

    /**
     * Fields allowed to Factory 
     *
     * @var array
     */
    protected $fillable = [
        'status_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
