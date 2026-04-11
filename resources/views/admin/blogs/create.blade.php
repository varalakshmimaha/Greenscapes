@extends('admin.layouts.app')
@section('title', 'Add New Blog Post')
@section('page-title', 'Add New Blog Post')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header"><h6 class="mb-0">Post Content</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Excerpt</label>
                        <textarea name="excerpt" class="form-control" rows="3" placeholder="Short summary of the post...">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header"><h6 class="mb-0">Post Settings</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Featured Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. Tips, News">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_published" class="form-check-input" id="is_published">
                            <label class="form-check-label" for="is_published">Publish Now</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>Save Post</button>
        </div>
    </div>
</form>
@endsection
