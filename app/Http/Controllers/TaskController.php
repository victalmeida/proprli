<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\DTO\IndexTaskDTO;
use App\Http\Services\Task\CreateTaskService;
use App\Http\Services\Task\UpdateTaskService;
use App\Http\Services\Task\IndexTaskService;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(IndexTaskRequest $request)
    {
        $indexTaskService = new IndexTaskService();
        $result = $indexTaskService->execute(IndexTaskDTO::makeFromRequest($request));
        return response()->json($result);
    }

    /**
     * @param CreateTaskRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateTaskRequest $request)
    {
        $createTaskService = new CreateTaskService();
        $result = $createTaskService->execute(CreateTaskDTO::makeFromRequest($request));

        return response()->json($result, 201);
    }

    /**
     * @param UpdateTaskRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTaskRequest $request)
    {
        $updateTaskService = new UpdateTaskService();
        $result = $updateTaskService->execute(UpdateTaskDTO::makeFromRequest($request));

        return response()->json($result);
    }
}
