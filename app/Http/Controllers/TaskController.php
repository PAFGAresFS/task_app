<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Person;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::with('people')->get());
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'regex:/^[\w\s\-]{3,255}$/'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'integer'],
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'integer', 'in:0,1,2']
        ]);


        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada']);
    }

    public function assignTask(Request $request, Task $task)
    {
        $request->validate([
            'person_ids' => 'required|array',
            'person_ids.*' => 'exists:persons,id',
        ]);

        // Sincroniza las personas asignadas, sin eliminar las anteriores
        $task->people()->syncWithoutDetaching($request->person_ids);

        return response()->json(['message' => 'Personas asignadas exitosamente.']);
    }


    public function unassignTask(Request $request, Task $task)
    {
        $request->validate([
            'person_id' => 'required|exists:persons,id',
        ]);

        $task->people()->detach($request->person_id);

        return response()->json(['message' => 'Persona desasignada exitosamente.']);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }
}
