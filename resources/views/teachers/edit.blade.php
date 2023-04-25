@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Teacher</h1>
        <form action="{{ route('teachers.update', $teacher) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teacher->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $teacher->email) }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="subjects">Subjects</label>
                <select name="subjects[]" id="subjects" class="form-control @error('subjects') is-invalid @enderror" multiple required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ in_array($subject->id, old('subjects', $teacher->subjects->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subjects')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="Active" {{ old('status', $teacher->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $teacher->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
