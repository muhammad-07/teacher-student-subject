@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assign Student</h1>
        <form action="{{ route('assignments.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="teacher_id">Teacher*</label>
                <select name="teacher_id" id="teacher_id" class="form-control" required>
                    <option value="">Select Teacher</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subject_id">Subject*</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    <option value="">Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="students">Assign Students*</label>
                <select name="students[]" id="students" class="form-control" multiple required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('students')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
