@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <h1>Projects</h1>
    <form action="{{ route('projects.search') }}" method="GET" class="search-form">
        <input type="text" name="name" placeholder="Search by name">
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('projects.create') }}" class="btn">Create New Project</a>
    <ul class="project-list">
        @foreach ($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
