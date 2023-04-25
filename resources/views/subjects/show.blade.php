@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Subject Details</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $subject->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $subject->name }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $subject->status }}</td>
            </tr>
        </table>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
