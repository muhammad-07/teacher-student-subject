@extends('layouts.app')

@section('content')
    <h1>Assignments</h1>
    <a href="{{ route('assignments.create') }}" class="btn btn-primary mb-3">Create Assignment</a>
    <table class="table">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Subject</th>
                <th>Assigned Students</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->teacher->name }}</td>
                    <td>{{ $assignment->subject->name }}</td>
                    <td>{{ implode(', ', $assignment->students->pluck('name')->toArray()) }}</td>
                    <td>{{ $assignment->status }}</td>
                    <td>
                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
