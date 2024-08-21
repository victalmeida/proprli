<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    
    /**
     * Get Task Status
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TaskStatus $taskStatus)
    {
        $status = TaskStatus::all();
        return response()->json($status);
    }
}
