@extends('admin.layouts.app')
@section('title', 'Add New Banner')
@section('page-title', 'Add New Banner')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Banners</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Banner Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" required accept="image/*">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link') }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Banner</button>
        </form>
    </div>
</div>
@endsection
