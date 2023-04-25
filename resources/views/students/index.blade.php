@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>
        @if (count($students) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subjects</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                @foreach ($student->subjects as $subject)
                                    {{ $subject->name }}<br>
                                @endforeach
                            </td>
                            <td>{{ $student->status }}</td>
                            <td>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $students->links() }}
        @else
            <p>No students found.</p>
        @endif
    </div>
@endsection
