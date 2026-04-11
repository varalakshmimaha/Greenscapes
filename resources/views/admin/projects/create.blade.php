@extends('admin.layouts.app')
@section('title', 'Add Project')
@section('page-title', 'Add Project')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Project Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Before Image</label>
                    <input type="file" name="before_image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">After Image</label>
                    <input type="file" name="after_image" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Project</button>
        </form>
    </div>
</div>
@endsection
