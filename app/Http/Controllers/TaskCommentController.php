<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskCommentRequest;
use App\Http\Services\TaskComment\CreateTaskCommentService;
use App\DTO\CreateTaskCommentDTO;


class TaskCommentController extends Controller
{
    /**
     * @param CreateTaskCommentRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateTaskCommentRequest $request)
    {
        $createTaskCommentService = new CreateTaskCommentService();
        $result = $createTaskCommentService->execute(CreateTaskCommentDTO::makeFromRequest($request));
        return response()->json($result, 201);
    }
}
