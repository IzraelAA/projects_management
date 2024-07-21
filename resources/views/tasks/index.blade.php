@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>

    <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request()->get('search') }}">
        </div>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    @if($tasks->isEmpty())
        <p>No tasks found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
