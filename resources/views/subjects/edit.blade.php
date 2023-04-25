@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Subject</h1>
        <form action="{{ route('subjects.update', $subject->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $subject->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="Active" {{ old('status', $subject->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $subject->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
