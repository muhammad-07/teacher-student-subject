<!-- resources/views/assignments/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Assignment</h1>
    <form action="{{ route('assignments.update', $assignment->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="teacher_id">Teacher*</label>
            <select name="teacher_id" id="teacher_id" class="form-control" required>
                <option value="">Select Teacher</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $teacher->id == $assignment->teacher_id ? 'selected' : '' }}>
                        {{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject_id">Subject*</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $assignment->subject_id ? 'selected' : '' }}>
                        {{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="student_ids">Assign Students*</label>
            <select name="student_ids[]" id="student_ids" class="form-control" multiple required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}"
                        {{ in_array($student->id, $assignment->students->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status*</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ $assignment->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $assignment->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
