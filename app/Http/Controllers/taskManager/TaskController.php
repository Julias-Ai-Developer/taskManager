<?php

namespace App\Http\Controllers\taskManager;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Task::paginate(10);
        return Inertia::render('taskManager/tasks/Index', [
            'tasks' => $tasks,
            'statuses' => collect(TaskStatusEnum::cases())->map(fn($status) => [
                'value' => $status->value,
                'label' => $status->label(),
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'required|string',
        ]);

        Task::create($validated);

        return redirect()->route('tasks')->with('success', 'Task created successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
