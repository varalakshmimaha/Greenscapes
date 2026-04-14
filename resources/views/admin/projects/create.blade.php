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
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. Residential, Commercial">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. Bengaluru, Karnataka">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control" value="{{ old('area') }}" placeholder="e.g. 5,000 Sq. Ft.">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Completion Date</label>
                    <input type="text" name="completion_date" class="form-control" value="{{ old('completion_date') }}" placeholder="e.g. December 2024">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Project Manager</label>
                    <input type="text" name="project_manager" class="form-control" value="{{ old('project_manager') }}" placeholder="e.g. SR Greenscapes Experts">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                    <small class="text-muted">Main image displayed on the project card and hero banner.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gallery Images</label>
                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">Select multiple images for the project gallery.</small>
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
