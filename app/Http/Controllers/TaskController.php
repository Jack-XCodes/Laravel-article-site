<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return Inertia::render('tasks/index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('tasks/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'completed' => 'required',
        ]);

        auth()->user()->tasks()->create($request->only(['title', 'completed']));

        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return Inertia::render('tasks/edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        Gate::authorize('update', $task);
        $request->validate([
            'title' => 'required',
            'completed' => 'required',
        ]);
        $task->update($request->only(['title', 'completed']));
        return redirect()->route('tasks.index');
    }
}
