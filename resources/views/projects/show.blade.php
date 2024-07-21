@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Start Date: {{ $project->start_date }}</p>
    <p>End Date: {{ $project->end_date }}</p>
    <h2>Tasks</h2>
    <a href="{{ route('tasks.create') }}">Add Task</a>
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->title }} - {{ $task->status }}
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
