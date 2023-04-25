@extends('layouts.app')

@section('content')
    <h1>Assignment Details</h1>
    <table class="table">
        <tbody>
            <tr>
                <th>Teacher</th>
                <td>{{ $assignment->teacher->name }}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{ $assignment->subject->name }}</td>
            </tr>
            <tr>
                <th>Assigned Students</th>
                <td>{{ implode(', ', $assignment->students->pluck('name')->toArray()) }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $assignment->status }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('assignments.index') }}" class="btn btn-primary">Back</a>
@endsection
