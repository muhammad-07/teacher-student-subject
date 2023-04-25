@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Subjects</h1>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Create Subject</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->status }}</td>
                        <td>
                            {{-- <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-info">View</a> --}}
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
