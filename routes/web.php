<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::resource('/', ProjectController::class);

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

// Route untuk menampilkan kemajuan proyek dalam bentuk grafik
Route::get('projects/progress', [ProjectController::class, 'progress'])->name('projects.progress');

// Route untuk fitur pencarian proyek
Route::get('projects/search', [ProjectController::class, 'search'])->name('projects.search'); 

// Rute untuk daftar tugas
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Rute untuk form pembuatan tugas
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

// Rute untuk menyimpan tugas
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Rute untuk form edit tugas
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

// Rute untuk memperbarui tugas
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
