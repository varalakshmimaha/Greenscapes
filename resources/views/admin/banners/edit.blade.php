@extends('admin.layouts.app')
@section('title', 'Edit Banner')
@section('page-title', 'Edit Banner')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Banners</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Banner</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $banner->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Banner Image</label>
                @if($banner->image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$banner->image) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $banner->button_link) }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $banner->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Banner</button>
        </form>
    </div>
</div>
@endsection
