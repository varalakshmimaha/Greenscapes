@extends('admin.layouts.app')
@section('title', 'Add Gallery Image')
@section('page-title', 'Add Gallery Image')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Image Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. Landscaping, Garden">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" required accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Image</button>
        </form>
    </div>
</div>
@endsection
