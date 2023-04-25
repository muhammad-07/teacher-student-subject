@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Teachers</h1>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">Create Teacher</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subjects</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->subjects->pluck('name')->implode(', ') }}</td>
                        <td>{{ $teacher->status }}</td>
                        <td>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
