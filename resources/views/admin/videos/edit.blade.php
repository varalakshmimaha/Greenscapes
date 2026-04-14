@extends('admin.layouts.app')
@section('title', 'Edit Video')
@section('page-title', 'Edit Video')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Video</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $video->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Video URL <span class="text-danger">*</span></label>
                <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $video->video_url) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $video->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Thumbnail Image</label>
                @if($video->thumbnail)
                    <div class="mb-2"><img src="{{ asset('storage/'.$video->thumbnail) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                @endif
                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current thumbnail</small>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $video->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Video</button>
        </form>
    </div>
</div>
@endsection
