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
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $project->category) }}" placeholder="e.g. Residential, Commercial">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $project->client_name) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $project->location) }}" placeholder="e.g. Bengaluru, Karnataka">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control" value="{{ old('area', $project->area) }}" placeholder="e.g. 5,000 Sq. Ft.">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Completion Date</label>
                    <input type="text" name="completion_date" class="form-control" value="{{ old('completion_date', $project->completion_date) }}" placeholder="e.g. December 2024">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Project Manager</label>
                    <input type="text" name="project_manager" class="form-control" value="{{ old('project_manager', $project->project_manager) }}" placeholder="e.g. SR Greenscapes Experts">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- Featured Image --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Featured Image</label>
                    @if($project->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$project->featured_image) }}" class="img-thumbnail" style="max-height:120px" alt="">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                    <small class="text-muted">Main image displayed on the project card and hero banner.</small>
                </div>

                {{-- Gallery Images Upload --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Add Gallery Images</label>
                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">Select multiple images to add to the gallery.</small>
                </div>
            </div>

            {{-- Existing Gallery Images --}}
            @if($project->gallery_images && count($project->gallery_images))
                <div class="mb-3">
                    <label class="form-label">Current Gallery Images</label>
                    <div class="row g-3">
                        @foreach($project->gallery_images as $galleryImg)
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="position-relative border rounded overflow-hidden">
                                    <img src="{{ asset('storage/'.$galleryImg) }}" class="img-fluid" style="height:120px;width:100%;object-fit:cover;" alt="">
                                    <div class="form-check position-absolute top-0 end-0 m-1">
                                        <input type="checkbox" name="remove_gallery[]" value="{{ $galleryImg }}" class="form-check-input bg-danger border-danger" id="rm_{{ $loop->index }}" title="Remove this image">
                                        <label class="form-check-label text-white small" for="rm_{{ $loop->index }}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted mt-1 d-block">Check the images you want to remove.</small>
                </div>
            @endif

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
