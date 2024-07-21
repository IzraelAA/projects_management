@extends('layouts.app')

@section('title', 'Project Progress')

@section('content')
    <h1>Project Progress</h1>
    <canvas id="projectProgressChart" class="my-4"></canvas>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('projectProgressChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($projectNames),
                datasets: [{
                    label: 'Tasks Completed',
                    data: @json($tasksCompleted),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
