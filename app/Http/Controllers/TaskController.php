<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project; // Import model Project
use Illuminate\Http\Request;

class TaskController extends Controller
{
	// Menampilkan daftar tugas
	public function index()
	{
		$tasks = Task::all(); // Mendapatkan semua tugas dari database
		return view('tasks.index', compact('tasks')); // Mengirimkan variabel tasks ke view
	}

	// Menampilkan form pembuatan tugas
	public function create()
	{
		$projects = Project::all(); // Mendapatkan semua project dari database
		return view('tasks.create', compact('projects')); // Mengirimkan variabel projects ke view
	}

	// Menyimpan tugas baru
	public function store(Request $request)
	{
		// Validasi dan simpan tugas baru
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'status' => 'required|string|in:not_started,in_progress,completed',
			'project_id' => 'required|exists:projects,id',
		]);

		Task::create($validated);
		return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
	}

	// Menampilkan form edit tugas
	public function edit(Task $task)
	{
		$projects = Project::all(); // Mendapatkan semua project untuk dropdown di view edit
		return view('tasks.edit', compact('task', 'projects')); // Mengirimkan variabel task dan projects ke view
	}

	// Memperbarui tugas
	public function update(Request $request, Task $task)
	{
		// Validasi dan perbarui tugas
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'status' => 'required|string|in:not_started,in_progress,completed',
			'project_id' => 'required|exists:projects,id',
		]);

		$task->update($validated);
		return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
	}
}