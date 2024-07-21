<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Project::create($validated);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $tasks = $project->tasks()->get();
        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function progress()
    {
        $projects = Project::withCount(['tasks as tasks_completed' => function ($query) {
            $query->where('status', 'completed');
        }])->get();

        return view('projects.progress', compact('projects'));
    }

    public function search(Request $request)
    {
        $query = Project::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '=', $request->end_date);
        }

        $projects = $query->get();

        return view('projects.index', compact('projects'));
    }
}