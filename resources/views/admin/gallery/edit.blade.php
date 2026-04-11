@extends('admin.layouts.app')
@section('title', 'Edit Gallery Image')
@section('page-title', 'Edit Gallery Image')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Image</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $gallery->category) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                @if($gallery->image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$gallery->image) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description) }}</textarea>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $gallery->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Image</button>
        </form>
    </div>
</div>
@endsection
