<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->taskService->listForUser($request->user())
        );
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->create($request->user(), $request->validated());

        return response()->json($task, 201);
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task = $this->taskService->update($task, $request->validated());

        return response()->json($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);

        $this->taskService->delete($task);

        return response()->json(null, 204);
    }
}
