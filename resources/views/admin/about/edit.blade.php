@extends('admin.layouts.app')
@section('title', 'Edit About Section')
@section('page-title', 'Edit About Section')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.about.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit About Section</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $about->title) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Section <span class="text-danger">*</span></label>
                    <select name="section" class="form-select" required>
                        @foreach(['overview', 'mission', 'vision', 'history', 'values'] as $sec)
                            <option value="{{ $sec }}" {{ old('section', $about->section) == $sec ? 'selected' : '' }}>{{ ucfirst($sec) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $about->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                @if($about->image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$about->image) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $about->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Section</button>
        </form>
    </div>
</div>
@endsection
