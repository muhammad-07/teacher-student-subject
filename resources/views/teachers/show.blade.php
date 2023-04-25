@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>teacher Details</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $teacher->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $teacher->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $teacher->email }}</td>
            </tr>
            <tr>
                <th>Grade</th>
                <td>{{ $teacher->subjects }}</td>
            </tr>
        </table>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
