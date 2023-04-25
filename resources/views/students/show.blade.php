@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Details</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $student->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->email }}</td>
            </tr>
            <tr>
                <th>Grade</th>
                <td>{{ $student->subjects }}</td>
            </tr>
        </table>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
