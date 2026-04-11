@extends('admin.layouts.app')
@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Project</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $project->client_name) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Main Image</label>
                    @if($project->image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$project->image) }}" class="img-thumbnail" style="max-height:100px" alt=""></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Before Image</label>
                    @if($project->before_image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$project->before_image) }}" class="img-thumbnail" style="max-height:100px" alt=""></div>
                    @endif
                    <input type="file" name="before_image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">After Image</label>
                    @if($project->after_image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$project->after_image) }}" class="img-thumbnail" style="max-height:100px" alt=""></div>
                    @endif
                    <input type="file" name="after_image" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $project->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Project</button>
        </form>
    </div>
</div>
@endsection
